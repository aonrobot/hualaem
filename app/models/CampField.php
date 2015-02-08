<?php

class CampField extends Eloquent {
    
    const TEXT = "TEXT";
    const TEXTAREA = "TEXTAREA";
    const FILE = "FILE";
    
    public $timestamps = false;

    public function camp() {
        return $this->belongsTo('Camp');
    }

}
