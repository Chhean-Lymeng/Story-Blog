<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('auth.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('auth.permissions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:permissions,name'], ['name.required' => 'Field is required.']);
        $input = $request->all();
        $permissions = Permission::create($input);
        if ($permissions) {
            return redirect()->route('permissions.index')->with('message', 'Permission created');
        }
        return redirect()->route('permissions.index')->with('error', 'Something wrong');
    }

    public function show($id)
    {
        //
    }

    public function edit(Permission $permission)
    {
        return view('auth.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, ['name' => 'required|unique:permissions,name,' . $permission->id], ['name.required' => 'Field is required.']);
        $permissions = $permission->update(['name' => $request->name]);
        if ($permissions) {
            return redirect(route('permissions.index'))->with('message', 'Permission updated');
        }
        return redirect(route('permissions.index'))->with('error', 'Permission not updated');
    }

    public function destroy(Request $request)
    {
        $permissions = Permission::find($request->id);
        if ($permissions->delete()) {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Permission is deleted',
            ]);
        } else {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Something wrong',
            ]);
        }
    }
}
