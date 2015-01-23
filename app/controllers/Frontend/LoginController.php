<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Input;

class LoginController extends FrontendController {
    public function getIndex(){
        
    }
    
    public function postIndex(){
        $inp = Input::only(['username','password']);
        
        if(\Auth::attempt($inp)){
            return \Redirect::to('/');
        }else{
            return \Redirect::to('/')->withErrors(['login_incorrect'=>'Login error. Please check your username or password']);
        }
    }
}