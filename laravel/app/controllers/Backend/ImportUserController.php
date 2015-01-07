<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class ImportUserController extends BackendController {
    public function getIndex(){
        return $this->getStep1();
    }
    
    public function getStep1(){
        return $this->view('import.user.step1');
    }
}
