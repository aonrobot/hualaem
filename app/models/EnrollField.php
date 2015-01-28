<?php

class EnrollField extends Eloquent {
    
    public $timestamps = false;

    public function campFields() {
        return $this->belongsTo('CampField');
    }

    public function enroll(){
        return $this->belongsTo('Enroll');
    }
}