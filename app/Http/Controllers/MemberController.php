<?php


namespace App\Http\Controllers;


class MemberController extends Controller
{

    public function info($id){
        //return 'member-info-id-'.$id;
       //return route('memberinfo');
        //return view('member');
        return view('member/info',[
            'name'=>'ksx',
            'age'=>'20'
        ]);
    }

}