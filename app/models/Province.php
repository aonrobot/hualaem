<?php

class Province extends Eloquent {

    public $timestamps = false;

    public function distircts() {
        return $this->hasMany('District');
    }

    public function camps() {
        return $this->hasMany('Camp');
    }
    public function addresses(){
        return $this->hasMany('Address');
    }

}
