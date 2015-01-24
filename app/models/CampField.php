<?php

class CampField extends Eloquent {
    
    public $timestamps = false;

    public function camp() {
        return $this->belongsTo('Camp');
    }

}
