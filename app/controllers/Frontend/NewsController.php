<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;

class NewsController extends FrontendController {

    public function getView($newsID) {
        $news = \News::find($newsID);
        $lastestNews = \News::published()->orderBy('publish_at','desc')->limit(20)->get();
        
        return $this->view('news',compact('news','lastestNews'));
    }

}
