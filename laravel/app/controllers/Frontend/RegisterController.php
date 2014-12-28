<?php namespace mix5003\Hualaem\Frontend;

use FrontendController;

class RegisterController extends FrontendController {
    public function getIndex(){
        return $this->view('register');
    }
}