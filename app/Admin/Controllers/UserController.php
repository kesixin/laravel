<?php

namespace App\Admin\Controllers;
use \App\AdminUser;

class UserController extends Controller
{
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {

        return view('admin.user.add');
    }

    public function store()
    {
        $this->validate(request(),[
            'name'=>'required|min:4',
            'password'=>'required|min:4',
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));

        AdminUser::create(compact('name','password'));

        return redirect('/admin/users');

    }
}