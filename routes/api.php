<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('jwt.auth')->group(function () {
    Route::post("selectstudent",'informationFindController@zlcSelectstudent');//查看个人学生信息
    Route::post("danbai","PendulumController@zlcDanbai");//单摆
    Route::post("js","PendulumController@zlcJs");//单摆计算题

});
