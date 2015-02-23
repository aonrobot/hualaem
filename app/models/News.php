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
    
    public function getShortPublishAtAttribute() {
        $c = new \Carbon\Carbon($this->publish_at);
        return $c->format('Y-m-d');
    }
    
    public function scopePublished($query){
        $query->where('publish_at','<=',date('Y-m-d H:i:s'));
    }
}
