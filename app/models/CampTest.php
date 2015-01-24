<?php

class CampTest extends Eloquent {
    
    public $timestamps = false;

    public function subject() {
        return $this->belongsTo('Subject');
    }

}
