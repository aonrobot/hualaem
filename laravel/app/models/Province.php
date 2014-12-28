<?php

class Province extends Eloquent {
    
    public $timestamps = false;

    public function distircts() {
        return $this->hasMany('District');
    }

}
