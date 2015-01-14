<?php

class SubDistrict extends Eloquent {

    public $timestamps = false;

    public function district() {
        return $this->belongsTo('District');
    }

}
