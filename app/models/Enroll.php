<?php

class Enroll extends Eloquent {

    public function camp() {
        return $this->belongsTo('Camp');
    }

    public function user() {
        return $this->belongsTo('User');
    }
    
    public function fields(){
        return $this->hasMany('EnrollField');
    }

}
