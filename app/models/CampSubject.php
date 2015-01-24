<?php

class CampSubject extends Eloquent {
    
    public $timestamps = false;

    public function camp() {
        return $this->belongsTo('Camp');
    }

    public function tests(){
        return $this->hasMany('CampTest');
    }
}
