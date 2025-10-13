<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view('admin.backend.pages.permission.all_permission', compact('permissions'));

    }
    //End method
    public function AddPermission(){
        $permissions = Permission::all();
        return view('admin.backend.pages.permission.add_permission', compact('permissions'));

    }
    //End method
    public function StorePermission(Request $request){
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Permission Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }
    //End method
    public function EditPermission($id){
        $permissions = Permission::findOrFail($id);
        return view('admin.backend.pages.permission.edit_permission', compact('permissions'));
    }
    //End method

    public function UpdatePermission(Request $request){
        $per_id = $request->id;
        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }
    //End method
    public function DeletePermission($id){
        Permission::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }
    //End method

    //Roles
    public function AllRole(){
        $roles = Role::all();
        return view('admin.backend.pages.role.all_role', compact('roles'));

    }
    //End method
    public function AddRole(){
        $permissions = Permission::all();
        return view('admin.backend.pages.role.add_role', compact('permissions'));

    }
    //End method
    public function StoreRole(Request $request){
        Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        $notification = array(
            'message' => 'Role Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }
    //End method
    public function EditRole($id){
        $roles = Role::findOrFail($id);
        return view('admin.backend.pages.role.edit_role', compact('roles'));
    }
    //End method

    public function UpdateRole(Request $request){
        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }
    //End method
    public function DeleteRole($id){
        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 
    }
}
