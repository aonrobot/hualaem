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


Route::group(array(), function() {
    //Guest Group
    Route::controller('/', 'mix5003\Hualaem\Frontend\IndexController', [
        'getIndex' => 'index'
    ]);

    Route::controller('register', 'mix5003\Hualaem\Frontend\RegisterController', [
        'getIndex' => 'guest.register'
    ]);
    Route::controller('login', 'mix5003\Hualaem\Frontend\LoginController', [
        'getIndex' => 'guest.login'
    ]);
    Route::controller('camp', 'mix5003\Hualaem\Frontend\CampController', [
        'getIndex' => 'guest.camp.list',
        'getView' => 'guest.camp.view',
        'getRegister' => 'student.camp.register'
    ]);
});

Route::group(array(), function() {
    // User Group
    Route::controller('user', 'mix5003\Hualaem\Frontend\UserController', [
        'getCalendar' => 'student.user.calendar',
        'getCalendarData' => 'ajax.student.calendar_data',
    ]);
});

Route::group(array('prefix' => 'admin'), function() {
    //Admin Group
    Route::controller('import', 'mix5003\Hualaem\Backend\ImportUserController', [
        'getIndex' => 'admin.import.index',
        'getStep1' => 'admin.import.step1',
        'getStep2' => 'admin.import.step2',
        'getStep3' => 'admin.import.step3',
    ]);

    Route::controller('upload', 'mix5003\Hualaem\Backend\UploadController', [
        'postImage' => 'admin.upload.image',
        'postFile' => 'admin.upload.file'
    ]);

    Route::controller('camp', 'mix5003\Hualaem\Backend\CampController', [
        'getIndex' => 'admin.camp.list',
        'getView' => 'admin.camp.view',
        'getAdd' => 'admin.camp.add',
        'getApplication' => 'admin.camp.application',
        'getEdit' => 'admin.camp.edit',
        'postSave' => 'admin.camp.save',
        'getAjaxCampField' => 'ajax.admin.camp.camp_fields',
        'getDownloadApplicationFile' => 'admin.camp.download_application_file',
        'getScore' => 'admin.camp.score',
        'getCampScore' => 'admin.camp.camp_score',
    ]);

    Route::controller('user', 'mix5003\Hualaem\Backend\UserController', [
        'getIndex' => 'admin.user.list',
        'postMassUpdateUser' => 'admin.user.mass_update_user',
        'getView' => 'admin.user.view',
        'getEdit' => 'admin.user.edit',
    ]);

    Route::controller('news', 'mix5003\Hualaem\Backend\NewsController', [
        'getIndex' => 'admin.news.list',
        'getAdd' => 'admin.news.add',
        'getEdit' => 'admin.news.edit',
        'postSave' => 'admin.news.save',
    ]);
});

