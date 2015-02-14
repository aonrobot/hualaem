<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class UserController extends BackendController {
    public function getIndex(){
        $users = \User::orderBy('id','desc')->paginate();
        
        return $this->view('user.list',  compact('users'));
    }
}
