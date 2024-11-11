<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(10);
        return view('auth.users.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('auth.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required',
        ], [
            'name.required' => 'Field is required.',
            'email.required' => 'Field is required.',
            'password.required' => 'Field is required.',
            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.regex' => 'Password must contain at least one uppercase letter and one number.',
            'roles.required' => 'Field is required.',
        ]);
        $input = $request->all();
        $input['status'] = $request->get('status') == "on" ? true : false;
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        if ($user) {
            $user->assignRole($request->input('roles'));
            return redirect()->route('users.index')->with('message', 'User created');
        }
        return redirect()->route('users.index')->with('error', 'Something wrong');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('auth.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('auth.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required',
        ], [
            'name.required' => 'Field is required.',
            'email.required' => 'Field is required.',
            'roles.required' => 'Field is required.',
        ]);
        if (!empty($input['password'])) {
            $request->validate([
                'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/[0-9]/',
            ], [
                'password.required' => 'Field is required.',
                'password.string' => 'Password must be a string.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.regex' => 'Password must contain at least one uppercase letter and one number.',
            ]);
        }

        $input = $request->all();
        $input['status'] = $request->get('status') == "on" ? true : false;
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        if ($user->update($input)) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->input('roles'));
            return redirect()->route('users.index')->with('message', 'User updated');
        }
        return redirect()->route('users.index')->with('error', 'User not updated');
    }

    public function destroy(Request $request)
    {
        $users = User::find($request->id);
        if ($users->delete()) {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'User is deleted',
            ]);
        } else {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Something wrong',
            ]);
        }
    }

    public function profile()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        return view('auth.users.profile')->with(['user' => $user]);
    }

    public function update_profile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ], [
            'name.required' => 'Field is required.',
            'email.required' => 'Field is required.',
        ]);
        $input = $request->all();
        $user = User::find($id);
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        if ($user->update($input)) {
            return redirect()->route('home')->with('message', 'Profile updated');
        }
        return redirect()->route('home')->with('error', 'Profile not updated');
    }

}
