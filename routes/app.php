<?php
/**
 * 此处存放对外部系统提供接口的路由，接口校验采用sign签名方式
 */
Route::post('/test', 'TestController@test');
