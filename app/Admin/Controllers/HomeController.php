<?php


namespace App\Admin\Controllers;
use App\Admin\Controllers\Controller;


class HomeController extends Controller
{
    //首页
    public function index()
    {
        return view('admin.home.index');
    }

}