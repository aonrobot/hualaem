<?php

class Enroll extends Eloquent {
    
    const STATUS_PENDING = "PENDING";
    const STATUS_DOCUMENT_RECIEVED = "DOCUMENT_RECIEVED";
    const STATUS_APPROVED = "APPROVED";
    
    const ROLE_STUDENT = "STUDENT";
    const ROLE_STAFF = "STAFF";

    public function camp() {
        return $this->belongsTo('Camp');
    }

    public function user() {
        return $this->belongsTo('User');
    }
    
    public function fields(){
        return $this->hasMany('EnrollField');
    }
    
    public function scores(){
        return $this->hasMany('EnrollScore');
    }

}
