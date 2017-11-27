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

//Route::get('/', function () {
//    return view('welcome');
//});
////
//Route::get('/basic1',function(){
//    return "hello world1";
//});
//
//Route::post('/basic2',function(){
//    return "hello world2";
//});
//
////多请求路由
//Route::match(['get','post'],'multy1',function (){
//    return 'multy1';
//});
//
//Route::any('multy2',function (){
//    return 'multy2';
//});
//
//
////路由参数
////Route::get('/user/{id}',function ($id){
////    return 'User-id-'.$id;
////});
//
////Route::get('/user/{name?}',function ($name=null){
////    return 'User-name-'.$name;
////});
//
////Route::get('/user/{name?}',function ($name='mike'){
////    return 'User-name-'.$name;
////});
//
////路由验证
////Route::get('/user/{name?}',function ($name='sean'){
////    return 'User-name-'.$name;
////})->where('name','[A-Za-z]+');
////
////Route::get('/user/{id}/{name?}',function ($id,$name='sean'){
////    return 'User-id-'.$id.'-name-'.$name;
////})->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);
//
//
////路由别名
////Route::get('/user/center',['as'=>'center',function(){
////    return route('center');
////}]);
//
////路由群组
//Route::group(['prefix'=>'member'],function(){
//
//    Route::get('/user/center',['as'=>'center',function(){
//        return route('center');
//    }]);
//
//    Route::any('multy2',function (){
//        return 'member-multy2';
//    });
//});
//
//
//
////Route::get('member/info','MemberController@info');
//
//Route::get('member/info',['uses'=>'MemberController@info']);
//
////Route::any('member/info',[
////    'uses'=>'MemberController@info',
////    'as'=>'memberinfo'
////]);
//
////验证路由
//Route::get('member/{id}',['uses'=>'MemberController@info'])->where('id','[0-9]+');
//
//Route::get('test1',['uses'=>'TestController@test1']);
//
//Route::get('test2',['uses'=>'TestController@test2']);
//
//Route::get('section1',['uses'=>'TestController@section1']);
//
//Route::any('/uploads', 'StudentController@uploads');
//
//Route::get('/mail','StudentController@mail');
//
//Route::get('/cache1','StudentController@cache1');
//
//Route::get('/cache2','StudentController@cache2');
//
//Route::get('/error','StudentController@error');
//
//Route::group(['middleware'=>['web']],function (){
//
//    Route::get('/session1','SessionController@session1');
//
//    Route::get('/session2','SessionController@session2');
//});
////Route::get('/session1','SessionController@session1');
////
////Route::get('/session2','SessionController@session2');
//
//Route::get('/response','ResponseController@response');
//
//Route::get('/activity0','ActivityController@activity0');
//
//Route::group(['middleware'=>['activity']],function (){
//
//    Route::get('/activity1','ActivityController@activity1');
//    Route::get('/activity2','ActivityController@activity2');
//
//});
//
//
////Route::resource('post','PostController');
//
//
//
//
//
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index');
//
//Route::group(['middleware'=>['web']],function (){
//
//    Route::get('student/index',['uses'=>'StudentController@index']);
//    Route::any('student/create',['uses'=>'StudentController@create']);
//    Route::any('student/save',['uses'=>'StudentController@save']);
//    Route::any('student/update/{id}',['uses'=>'StudentController@update']);
//});


/*
 * 简书快速开发路由
 */

//用户模块
//注册页面
Route::get('/register', ['uses' => 'RegisterController@index']);
//注册行为
Route::post('/register', ['uses' => 'RegisterController@register']);
//登录页面
Route::get('/login', ['uses' => 'LoginController@index']);
//登录行为
Route::post('/login', ['uses' => 'LoginController@login']);

Route::group(['middleware' => 'auth:web'], function () {
    //登出行为
    Route::get('/logout', ['uses' => 'LoginController@logout']);
    //用户个人设置页面
    Route::get('/user/me/setting', ['uses' => 'UserController@setting']);
    //信息保存
    Route::post('/user/me/setting', ['uses' => 'UserController@settingstore']);

    //文章模块
    //文章列表页
    Route::get('/posts', ['uses' => 'PostController@index']);
    //创建文章
    Route::get('/posts/create', ['uses' => 'PostController@create']);
    Route::post('/posts', ['uses' => 'PostController@store']);
    //文章搜索
    Route::get('/posts/search', '\App\Http\Controllers\PostController@search');
    //文章详情页
    Route::get('/posts/{post}', ['uses' => 'PostController@show']);
    //编辑文章
    Route::get('/posts/{post}/edit', ['uses' => 'PostController@edit']);
    Route::put('/posts/{post}', ['uses' => 'PostController@update']);
    //删除文章
    Route::get('/posts/{post}/delete', ['uses' => 'PostController@delete']);
    //图片上传
    Route::post('/posts/image/upload', ['uses' => 'PostController@imageUpload']);
    //评论提交
    Route::post('/posts/{post}/comment',['uses'=>'PostController@comment']);

    Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
    Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');

    //个人中心
    Route::get('/user/{user}',['uses'=>'UserController@show']);
    Route::post('/user/{user}/fan',['uses'=>'UserController@fan']);
    Route::post('/user/{user}/unfan',['uses'=>'UserController@unfan']);

    //专题模块
    //专题详情页
    Route::get('/topic/{topic}',['uses'=>'TopicController@show']);
    //专题投稿
    Route::post('/topic/{topic}/submit',['uses'=>'TopicController@submit']);

    //通知列表
    Route::get('/notices',['uses'=>'NoticeController@index']);


});

//include_once ('admin.php');

//管理后台
Route::group(['prefix' => 'admin'], function () {

    //登录页面
    Route::get('/login', '\App\Admin\Controllers\LoginController@index');
    //登录提交
    Route::post('/login', '\App\Admin\Controllers\LoginController@login');
    //登出
    Route::get('/logout', '\App\Admin\Controllers\LoginController@logout');

    Route::group(['middleware' => 'auth:admin'], function () {
        //首页
        Route::get('/home', '\App\Admin\Controllers\HomeController@index');

        Route::group(['middleware' => 'can:system'], function () {

            //管理人员模块
            Route::get('/users', '\App\Admin\Controllers\UserController@index');
            Route::get('/users/create', '\App\Admin\Controllers\UserController@create');
            Route::post('/users/store', '\App\Admin\Controllers\UserController@store');
            Route::get('/users/{user}/role', '\App\Admin\Controllers\UserController@role');
            Route::post('/users/{user}/role', '\App\Admin\Controllers\UserController@storeRole');


            //角色
            Route::get('/roles', '\App\Admin\Controllers\RoleController@index');
            Route::get('/roles/create', '\App\Admin\Controllers\RoleController@create');
            Route::post('/roles/store', '\App\Admin\Controllers\RoleController@store');
            Route::get('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@permission');
            Route::post('/roles/{role}/permission', '\App\Admin\Controllers\RoleController@storePermission');

            //权限
            Route::get('/permissions', '\App\Admin\Controllers\PermissionController@index');
            Route::get('/permissions/create', '\App\Admin\Controllers\PermissionController@create');
            Route::post('/permissions/store', '\App\Admin\Controllers\PermissionController@store');
        });

        Route::group(['middleware' => 'can:post'], function () {

            //审核模块
            Route::get('/posts', '\App\Admin\Controllers\PostController@index');
            Route::post('/posts/{post}/status', '\App\Admin\Controllers\PostController@status');
        });


//        Route::get('/topics','\App\Admin\Controllers\TopicController@index');
//        Route::get('/topics/create','\App\Admin\Controllers\TopicController@create');
//        Route::post('/topics','\App\Admin\Controllers\TopicController@store');
//        Route::delete('/topics/{topic}','\App\Admin\Controllers\TopicController@destroy');
//          ==

        Route::group(['middleware' => 'can:topic'], function () {

            Route::resource('topics', '\App\Admin\Controllers\TopicController', ['only' => [
                'index', 'create', 'store', 'destroy'
            ]]);

        });

        Route::group(['middleware' => 'can:notice'], function () {
            Route::resource('notices', '\App\Admin\Controllers\NoticeController', ['only' => [
                'index', 'create', 'store'
            ]]);
        });

    });

});




