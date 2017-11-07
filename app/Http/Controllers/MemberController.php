<?php


namespace App\Http\Controllers;


use App\Member;

class MemberController extends Controller
{

    public function info($id){
        //return 'member-info-id-'.$id;
       //return route('memberinfo');
        //return view('member');
//        return view('member/info',[
//            'name'=>'ksx',
//            'age'=>'20'
//        ]);

        //模型调用

//        return Member::getMember();
        $Member=new Member();
        return $Member->Members();

    }

}