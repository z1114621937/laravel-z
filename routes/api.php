<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * 登录注册模块
 */
Route::prefix('user')->group(function () {
    Route::post('login', 'Login\LoginController@login'); //super登陆                    (account,password)
    Route::post('adminlogin', 'Login\LoginController@adminlogin'); //admin登录          (account,password)
    Route::post('studentlogin', 'Login\LoginController@studentlogin'); //student登录    (account,password)

    Route::post('logout', 'Login\LoginController@logout'); //管理员退出登陆
    Route::post('registered', 'Login\LoginController@registered'); //super注册        (account,password,name,phone,email)
    Route::post('registereds', 'Login\LoginController@registereds'); //admin注册      (account,password,name,phone,email,type(1,2,3))
    Route::post('registeredss', 'Login\LoginController@registeredss'); //student注册  (account,password,name,phone,email)

    Route::any('mail/send','Login\MailController@send');//发送验证码                         (email)

    Route::post('change1', 'Login\LoginController@change1'); //super修改密码     (account,password)
    Route::post('change2', 'Login\LoginController@change2'); //admin修改密码     (account,password)
    Route::post('change3', 'Login\LoginController@change3'); //student修改密码   (account,password)
});//--pxy

/**
 * 上传文件 和图片
 * oys
 */
Route::prefix('file')->group(function () {
    Route::post('photo', 'File\FileController@upload'); //学生负责人个人信息查看  1
});
/**
 * 后台管理操作
 */
Route::prefix('back')->group(function (){
    Route::post('userlook','Back\BackController@user_look');   //查看user信息数据
    Route::post('alllook','Back\BackController@all_look');   //根据user查看个人发布数据
    Route::post('commentdelete','Back\BackController@comment_delete');   //根据user时间删除发布动态的数据
    Route::post('helpdelete','Back\BackController@help_delete');   //根据user时间删除发布的求助数据
    Route::post('allstatelook','Back\BackController@all_statelook');   //根据数据类型和时间查看个人发布数据
    Route::post('userclose','Back\BackController@user_close');   //禁用user
    Route::post('useropen','Back\BackController@user_open');   //开放user
    Route::post('looktime','Back\BackController@look_time');   //根据userid和state查询时间
    Route::post('commentalldongtai','Back\BackController@comment_alldongtai');   //查询所有动态
    Route::post('helpallqiuzhu','Back\BackController@help_allqiuzhu');   //查询所有求助
    Route::post('commentnamedongtai','Back\BackController@comment_namedongtai');   //根据姓名查询动态
    Route::post('helpnameqiuzhu','Back\BackController@help_nameqiuzhu');   //根据姓名查询动态求助
    Route::post('commentdeletedongtai','Back\BackController@comment_deletedongtai');   //根据user时间与删除发布的动态
    Route::post('helpdeleteqiuzhu','Back\BackController@help_deleteqiuzhu');   //根据user时间与删除发布的求助
});//--wzh
/**
 * 钉钉登录获取信息相关操作
 */
Route::prefix('dingding')->group(function (){
    Route::get('token','Dingding\GetController@getToken');  //获取token
    Route::get('form','Dingding\GetController@getform');    // 获取基本的信息并存入数据库
    Route::get('photo','Dingding\GetController@gettutu');   //获取图片并存入数据库
});//--wzh

