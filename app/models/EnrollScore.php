<?php

class EnrollScore extends Eloquent {
    
    public $timestamps = false;

    public function test() {
        return $this->belongsTo('CampTest');
    }

    public function enroll(){
        return $this->belongsTo('Enroll');
    }
}