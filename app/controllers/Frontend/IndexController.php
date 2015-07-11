<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;

class IndexController extends FrontendController {

    public function getIndex() {
        $newses = \News::published()->orderBy('publish_at','desc')->take(10)->get();
        $camps = \Camp::openForRegisterCamp()->with('province','level')->orderBy('register_start','desc')->take(10)->get();
        
        return $this->view('other.index',compact('newses','camps'));
    }

}
