<?php


namespace App\Http\Controllers;


use App\Banner;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    //DB facade查询实例
    public function test1(){

        $arrData=DB::select("select * from ey_adminuser");
        var_dump($arrData);

    }

    //ORM查询实例
    public function test2(){

        //查询所有
        //$arrData=Banner::all();
        //id查询
        $arrData=Banner::find(154);

        var_dump($arrData);
    }

    //模板继承
    public function section1(){

        $arrData=['name'=>'ksx','age'=>18];
        $Banners=Banner::all();
        return view('member/section1', [
            'name'=>'ksx',
            'arrData'=>$arrData,
            'Banners'=>$Banners
        ]);
    }

}