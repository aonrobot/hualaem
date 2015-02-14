<?php

class Address extends Eloquent {

    public function user() {
        return $this->belongsTo('User');
    }
    
    public function province(){
        return $this->belongsTo('Province');
    }

    public function district(){
        return $this->belongsTo('District');
    }
    
    public function subDistrict(){
        return $this->belongsTo('SubDistrict');
    }
}
