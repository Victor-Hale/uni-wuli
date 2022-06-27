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
 * 物理数据
 * yjx
 */
Route::middleware('jwt.auth')->prefix('completion1')->group(function () {
    Route::post('completion1', 'PhysicsController@YJXphysics');//实验1答题
    Route::get('pdf1', 'PhysicsController@pdf1');//实验1pdf
});

/**
 * @author yjx
 * 登录模块
 */
Route::prefix('users')->group(function () {
    Route::post('login', 'UsersController@login');  //用户登录
    Route::post('registered', 'UsersController@registered');  //用户注册
    Route::post('again', 'UsersController@again');  //修改用户密码
});
