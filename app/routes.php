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
    Route::controller('register', 'mix5003\Hualaem\Frontend\RegisterController',[
        'getIndex' => 'guest.register'
    ]);
    Route::controller('login', 'mix5003\Hualaem\Frontend\LoginController',[
        'getIndex' => 'guest.login'
    ]);
});


Route::group(array('prefix' => 'admin'), function() {
    Route::controller('import', 'mix5003\Hualaem\Backend\ImportUserController',[
        'getIndex'=>'admin.import.index',
        'getStep1'=>'admin.import.step1',
        'getStep2'=>'admin.import.step2',
        'getStep3'=>'admin.import.step3',
    ]);
    
    Route::controller('camp', 'mix5003\Hualaem\Backend\CampController',[
        'getAdd'=>'admin.camp.add',
    ]);
});

