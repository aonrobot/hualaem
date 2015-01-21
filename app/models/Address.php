<?php

class Address extends Eloquent {

    public function user() {
        return $this->belongsTo('User');
    }

}
