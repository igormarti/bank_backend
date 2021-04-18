<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
], function () {

    Route::post('register','AuthController@create');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@profile');

    Route::middleware('jwt.verify')->group(function (){

        Route::group(['prefix' => 'user'],function (){
            Route::put('/{id}','UserController@update');
            Route::get('/{id}','UserController@show');
        });

        Route::group(['prefix' => 'transaction'],function (){
            Route::get('','TransactionController@index');
        });

        Route::group(['prefix' => 'withdraw'],function (){
            Route::post('','WithDrawController@create');
        });

        Route::group(['prefix' => 'deposit'],function (){
            Route::post('','DepositController@create');
        });

    });

});

