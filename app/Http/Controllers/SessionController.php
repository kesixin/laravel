<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class SessionController extends Controller
{
    //

    public function session1(Request $request)
    {
        //1.HTTP request session();
        //$request->session()->put('key1','val1');
        //2.session()
        //session()->put('key2','val2');
        //3.Session
        Session::put('key3','val3');
    }

    public function session2(Request $request)
    {
        //echo $request->session()->get('key1');

        //echo session()->get('key2');

        //echo Session::get('key3');

        return Session::get('message','暂无信息');
    }
}
