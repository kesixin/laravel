<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/basic1',function(){
    return "hello world1";
});

Route::post('/basic2',function(){
    return "hello world2";
});

//多请求路由
Route::match(['get','post'],'multy1',function (){
    return 'multy1';
});

Route::any('multy2',function (){
    return 'multy2';
});


//路由参数
//Route::get('/user/{id}',function ($id){
//    return 'User-id-'.$id;
//});

//Route::get('/user/{name?}',function ($name=null){
//    return 'User-name-'.$name;
//});

//Route::get('/user/{name?}',function ($name='mike'){
//    return 'User-name-'.$name;
//});

//路由验证
//Route::get('/user/{name?}',function ($name='sean'){
//    return 'User-name-'.$name;
//})->where('name','[A-Za-z]+');
//
//Route::get('/user/{id}/{name?}',function ($id,$name='sean'){
//    return 'User-id-'.$id.'-name-'.$name;
//})->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);


//路由别名
//Route::get('/user/center',['as'=>'center',function(){
//    return route('center');
//}]);

//路由群组
Route::group(['prefix'=>'member'],function(){

    Route::get('/user/center',['as'=>'center',function(){
        return route('center');
    }]);

    Route::any('multy2',function (){
        return 'member-multy2';
    });
});



//Route::get('member/info','MemberController@info');

Route::get('member/info',['uses'=>'MemberController@info']);

//Route::any('member/info',[
//    'uses'=>'MemberController@info',
//    'as'=>'memberinfo'
//]);

//验证路由
Route::get('member/{id}',['uses'=>'MemberController@info'])->where('id','[0-9]+');

Route::get('test1',['uses'=>'TestController@test1']);

Route::get('test2',['uses'=>'TestController@test2']);

Route::get('section1',['uses'=>'TestController@section1']);

Route::any('/uploads', 'StudentController@uploads');

Route::get('/mail','StudentController@mail');

Route::get('/cache1','StudentController@cache1');

Route::get('/cache2','StudentController@cache2');

Route::get('/error','StudentController@error');

Route::group(['middleware'=>['web']],function (){

    Route::get('/session1','SessionController@session1');

    Route::get('/session2','SessionController@session2');
});
//Route::get('/session1','SessionController@session1');
//
//Route::get('/session2','SessionController@session2');

Route::get('/response','ResponseController@response');

Route::get('/activity0','ActivityController@activity0');

Route::group(['middleware'=>['activity']],function (){

    Route::get('/activity1','ActivityController@activity1');
    Route::get('/activity2','ActivityController@activity2');

});


Route::resource('post','PostController');






Auth::routes();

Route::get('/home', 'HomeController@index');
