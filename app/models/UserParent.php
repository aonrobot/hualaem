<?php

class UserParent extends Eloquent {

    public function user() {
        return $this->belongsTo('User');
    }

}
