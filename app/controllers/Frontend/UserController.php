<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Input;

class UserController extends FrontendController {
    public function getCalendar(){
        return $this->view('user.calendar');
    }
}