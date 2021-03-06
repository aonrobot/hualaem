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
    Route::get('/', array('as' => 'guest.index', 'uses' => 'mix5003\Hualaem\Frontend\IndexController@getIndex'));
    Route::controller('news', 'mix5003\Hualaem\Frontend\NewsController', [
        'getView' => 'guest.news.view'
    ]);
    Route::controller('register', 'mix5003\Hualaem\Frontend\RegisterController', [
        'getIndex' => 'guest.register'
    ]);
    Route::controller('login', 'mix5003\Hualaem\Frontend\LoginController', [
        'getIndex' => 'guest.login'
    ]);
    Route::controller('forgot-password', 'mix5003\Hualaem\Frontend\ForgotPasswordController', [
        'getIndex' => 'guest.forgot.form',
        'getSetPassword' => 'guest.forget.set_password'
    ]);
    Route::controller('camp', 'mix5003\Hualaem\Frontend\CampController', [
        'getIndex' => 'guest.camp.list',
        'getView' => 'guest.camp.view',
        'getRegister' => 'student.camp.register'
    ]);
});

Route::group(array(
    'before'=>'auth'
), function() {
    // User Group
    Route::controller('user', 'mix5003\Hualaem\Frontend\UserController', [
        'getCalendar' => 'user.student.calendar',
        'getLogout' => 'user.logout',
        'getCalendarData' => 'ajax.student.calendar_data',
        'getProfile'=>'user.profile.view',
        'getEdit'=>'user.profile.edit',
        'getNotification'=>'user.notification',
    ]);

    Route::controller('pm','mix5003\Hualaem\Frontend\PrivateMessageController',[
        'getCreate' => 'user.pm.create',
        'getList'   => 'user.pm.list',
        'getView'   => 'user.pm.view',
        'postReply' => 'user.pm.reply',
    ]);
});

Route::group(array(
    'prefix' => 'admin',
    'before' => 'admin',
), function() {
    //Admin Group
    Route::get('/',function(){
       return View::make('backend.layout');
    });
    
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

        'postJudged' => 'admin.camp.judged',
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

    Route::controller('search', 'mix5003\Hualaem\Backend\SearchController', [
        'getUser'=> 'admin.search.user',
    ]);
});

