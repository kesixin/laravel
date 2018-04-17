<?php


namespace App\Admin\Controllers;

use App\Admin\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    //登录页面
    public function index()
    {
        return view('admin.login.index');
    }

    //登录提交
    public function login()
    {
        //验证
        $this->validate(request(),[
            'name'=>'required|min:2',
            'password'=>'required',
        ]);

        //逻辑
        $user = request(['name','password']);


        //Auth门脸
        if(Auth::guard('admin')->attempt($user)){
            return redirect('/admin/home');
        }

        return redirect()->back()->withErrors('登录失败');
    }

    //登出
    public function logout()
    {
        //由于admin_users 表没有remember_token,所以需要在AdminUser.php重写$remember_token
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}