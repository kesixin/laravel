<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //用户设置页面
    public function setting()
    {
        return view('user.setting');
    }

    //保存行为
    public function settingStore()
    {

    }


}
