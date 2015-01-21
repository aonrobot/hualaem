<?php

class District extends Eloquent {

    public $timestamps = false;

    public function sub_districts() {
        return $this->hasMany('SubDistrict');
    }

    public function province() {
        return $this->belongsTo('Province');
    }

}
