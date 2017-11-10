<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    //

    public function response()
    {
//        $data=[
//            'errCode'=>'0',
//            'errMsg'=>'success',
//            'errName'=>'正确'
//        ];

        //响应json
        //return response()->json($data);


        //重定向
        //return redirect('session2')->with('message','数据');

        //返回上一级页面
        return redirect()->back();

    }
}
