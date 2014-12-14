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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/test', function()
{
	return "Test";
});

Route::get(
            'debugbar/assets/stylesheets',
            array(
                'uses' => 'Barryvdh\Debugbar\Controllers\AssetController@css',
                'as' => 'debugbar2.assets.css',
            )
        );