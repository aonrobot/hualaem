<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */


Route::get('/', function() {
    return "hello";
});

Route::group(array(), function() {
    Route::controller('register', 'mix5003\Hualaem\Frontend\RegisterController');
});


Route::group(array('prefix' => 'admin'), function() {
    Route::controller('import', 'mix5003\Hualaem\Backend\ImportUserController');
});

