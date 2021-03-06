<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Illuminate\Http\Response;
use Input;

class LoginController extends FrontendController {
    public function getIndex(){
        return $this->view('user.login');
    }
    
    public function postIndex(){
        $inp = Input::only(['email','password']);
        
        if(\Auth::attempt($inp)){
            return \Redirect::to('/');
        }else{
            //TODO:: Change redirect
            return \Redirect::route('guest.login')->withInput()->withErrors(['login_incorrect'=>'Login error. Please check your username or password']);
        }
    }
}