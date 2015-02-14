<?php

class CampTest extends Eloquent {
    
    public $timestamps = false;

    public function subject() {
        return $this->belongsTo('Subject');
    }

    public function scores(){
        return $this->hasMany('EnrollScore');
    }
}
