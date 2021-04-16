<?php
Route::get('/admin/admin/welcome', 'AdminController@welcome');
Route::get('/', 'AdminController@index')->prefix('')->middleware('myAuth');

Route::middleware('myAuth')->prefix('admin')->group(function () {
    //角色添加
    Route::get('/role/add', 'RoleController@get');
    Route::post('/role/add', 'RoleController@add');
    //角色列表
    Route::get('/role/list', "RoleController@list");
    //角色删除
    Route::get('/role/del', "RoleController@del");
    //角色授权
    Route::get('/role/setMenu', 'RoleController@setMenu');
    Route::post('/role/setMenu', 'RoleController@setMenuDo');

    //菜单列表
    Route::get('/menu/list', 'MenuController@list');
    //添加菜单
    Route::get('/menu/edit', 'MenuController@get');
    Route::post('/menu/edit', 'MenuController@edit');
    //更改菜单顺序和层次
    Route::post('/menu/editSort', 'MenuController@editSort');
    //删除菜单
    Route::post('/menu/del', 'MenuController@del');

    //账号列表
    Route::get('/admin/list', 'AdminController@list');
    Route::get('/admin/list', 'AdminController@list');
    //帐号添加
    Route::get('/admin/add', 'AdminController@get');
    Route::post('/admin/add', 'AdminController@add');
    //修改密码
    Route::get('/admin/password', function () {
        return view('admin.admin.password');
    });
    Route::post('/admin/password', 'AdminController@passwordEdit');

    //帐号停用启用
    Route::post('/admin/stop', 'AdminController@stop');
    //账号删除
    Route::post('/admin/del', 'AdminController@del');
    //图片列表
    Route::get('/file/list', 'FileController@list');
    Route::post('/file/delete_img', 'FileController@delete_img');

    Route::get('/log/list', 'LogController@list');

});

Route::middleware('myAuth')->prefix('admin/api')->group(function () {
    Route::post('/upload', 'ApiController@upload');
});


