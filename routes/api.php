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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::group(['middleware' => 'auth:api'],function (){
        Route::group(['namespace' => 'Transaction', 'prefix' => 'transactions'],function (){
            Route::post('/', 'StoreHoursController');
            Route::patch('/{id}', 'UpdateTransactionController');
        });
        Route::group(['namespace' => 'User', 'prefix' => 'user'],function (){
            Route::patch('/{id}', 'UpdateUserController');
        });
    });

});

Route::group(['namespace' => 'User', 'prefix' => 'users'], function (){
    Route::post('/', 'StoreUserController');
    Route::get('/professions', 'ProfessionController');
});
