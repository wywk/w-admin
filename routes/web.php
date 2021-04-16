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

Route::get('/download','LoginController@download');
Route::get('/login',function (){
    return view('admin.login.login');
})->name('login');
Route::get('/websocket/{fd}','WebSocketController@send');
Route::get('/exist/{fd}','WebSocketController@exist');
Route::get('/send_userid/{userId}','WebSocketController@sendById');
Route::get('/logout','LoginController@logout');
Route::post('/port','LoginController@sendEmail');

Route::post('/login','LoginController@login');

//h5
Route::get('/h5/coupon/get',function (){
    return view('web.coupon.get');
});

//测试页面
Route::get('/index',function (){
    return view('xadmin.index');
});
Route::get('/welcome1',function (){
    return view('xadmin.welcome1');
});

Route::get('/welcome',function (){
    return view('xadmin.welcome');
});

Route::get('/member-list',function (){
    return view('xadmin.member-list');
});

Route::get('/member-list1',function (){
    return view('xadmin.member-list1');
});

Route::get('/member-del',function (){
    return view('xadmin.member-del');
});

Route::get('/order-list',function (){
    return view('xadmin.order-list');
});

Route::get('/order-list1',function (){
    return view('xadmin.order-list1');
});

Route::get('/cate',function (){
    return view('xadmin.cate');
});

Route::get('/city',function (){
    return view('xadmin.city');
});

Route::get('/admin-list',function (){
    return view('xadmin.admin-list');
});

Route::get('/admin-role',function (){
    return view('xadmin.admin-role');
});

Route::get('/admin-cate',function (){
    return view('xadmin.admin-cate');
});

Route::get('/admin-rule',function (){
    return view('xadmin.admin-rule');
});

Route::get('/echarts{id}',function ($id){
    return view('xadmin.echarts'.$id);
});

Route::get('/unicode',function (){
    return view('xadmin.unicode');
});

Route::get('/error',function (){
    return view('xadmin.error');
});

Route::get('/demo',function (){
    return view('xadmin.demo');
});

Route::get('/log',function (){
    return view('xadmin.log');
});

Route::get('/admin-add',function (){
    return view('xadmin.admin-add');
});

Route::get('/admin-edit',function (){
    return view('xadmin.admin-edit');
});

Route::get('/member-add',function (){
    return view('xadmin.member-add');
});

Route::get('/member-edit',function (){
    return view('xadmin.member-edit');
});

Route::get('/member-password',function (){
    return view('xadmin.member-password');
});

Route::get('/order-add',function (){
    return view('xadmin.order-add');
});

Route::get('/role-add',function (){
    return view('xadmin.role-add');
});

