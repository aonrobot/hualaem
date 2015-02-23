<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;

class NewsController extends FrontendController {

    public function getView($newsID) {
        $news = \News::find($newsID);
        
        return $this->view('news',compact('news'));
    }

}
