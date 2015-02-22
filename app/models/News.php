<?php

class News extends Eloquent {

    public function user() {
        return $this->belongsTo('User');
    }

    public function getExcerpt(){
        if(!empty($this->excerpt)){
            return $this->excerpt;
        }else{
            return $this->detail;
        }
    }
}
