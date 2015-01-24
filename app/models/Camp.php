<?php

class Camp extends Eloquent {

    public function fields(){
        return $this->hasMany('CampField');
    }
    
    public function subjects(){
        return $this->hasMany('CampSubject');
    }
    
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
