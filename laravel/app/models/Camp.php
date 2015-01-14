<?php

class Semester extends Eloquent {

    public function province() {
        return $this->belongsTo('Province');
    }

    public function enrolls() {
        return $this->hasMany('Enroll');
    }

    public function users() {
        return $this->hasManyThrough('User', 'Enroll');
    }

}
