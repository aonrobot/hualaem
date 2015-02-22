<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class NewsController extends BackendController {
    public function getIndex(){
        $news = \News::with('user')->orderBy('publish_at')->paginate(20);
        
        return $this->view('news.list',compact('news'));
    }
    
    public function getAdd(){
        
    }
    
    public function getEdit($newsId){
        
    }
    
    
}