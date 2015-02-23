<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;

class IndexController extends FrontendController {

    public function getIndex() {
        $newses = \News::published()->orderBy('publish_at','desc')->take(10)->get();
        $camps = \Camp::openForRegisterCamp()->orderBy('register_start','desc')->take(10)->get();
        
        return $this->view('index',compact('newses','camps'));
    }

}
