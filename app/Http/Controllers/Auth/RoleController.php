<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(10);
        return view('auth.roles.index',compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $permission = Permission::get();
        return view('auth.roles.create',compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ],[
            'name.required' => 'Field is required.',
            'permission.required' => 'Field is required.',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        if ($role) {
            $role->syncPermissions($request->input('permission'));
            return redirect()->route('roles.index')->with('message', 'Role created');
        }
        return redirect()->route('roles.index')->with('error', 'Something wrong');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        return view('auth.roles.show',compact('role','rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('auth.roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' .$id,
            'permission' => 'required',
        ],[
            'name.required' => 'Field is required.',
            'permission.required' => 'Field is required.',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        if ($role->save()) {
            $role->syncPermissions($request->input('permission'));
            return redirect()->route('roles.index')->with('message', 'Role updated');
        }
        return redirect()->route('roles.index')->with('error', 'Role not updated');
    }

    public function destroy(Request $request)
    {
        // DB::table("roles")->where('id',$id)->delete();
        // return redirect()->route('auth.roles.index')->with('success','Role deleted successfully');
        $role = Role::find($request->id);
        if ($role->delete()) {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Role is deleted',
            ]);
        } else {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Something wrong',
            ]);
        }
    }
}
