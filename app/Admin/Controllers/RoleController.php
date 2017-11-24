<?php

namespace App\Admin\Controllers;


class RoleController extends Controller
{

    public function index()
    {
        $roles = \App\AdminRole::paginate(10);
        return view('admin.role.index',compact('roles'));
    }

    public function create()
    {
        return view('admin.role.add');
    }

    public function store()
    {
        $this->validate(request(),[
            'name'=>'required|min:2',
            'description'=>'required',
        ]);

        $role=\App\AdminRole::create(request(['name','description']));

        return redirect('/admin/roles');
    }

    //角色权限关系页面
    public function permission(\App\AdminRole $role)
    {
        //获取所有权限
        $permissions=\App\AdminPermission::all();
        $myPermissions=$role->permissions;
        return view('admin.role.permission',compact('permissions','myPermissions','role'));
    }

    public function storePermission(\App\AdminRole $role)
    {

        $this->validate(request(),[
            'permissions'=>'required|array',
        ]);

        $permissions = \App\AdminPermission::findMany(request('permissions'));

        $myPermissions = $role->permissions;

        //要增加的权限
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission){
            $role->grantPermission($permission);
        }

        //要减少的权限
        $deletePermissions = $myPermissions->diff($permissions);
        foreach($deletePermissions as $permission){
            $role->deletePermission($permission);
        }

        return back();
    }
}