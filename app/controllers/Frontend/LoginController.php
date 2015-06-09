<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Input;

class LoginController extends FrontendController {
    public function getIndex(){
        return \Redirect::to('/');
    }
    
    public function postIndex(){
        $inp = Input::only(['email','password']);
        
        if(\Auth::attempt($inp)){
            return \Redirect::to('/');
        }else{
            //TODO:: Change redirect
            return \Redirect::to('/register')->withErrors(['login_incorrect'=>'Login error. Please check your username or password']);
        }
    }
}