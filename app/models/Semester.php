<?php

class Semester extends Eloquent {

    public function user() {
        return $this->belongsTo('User');
    }

    public function school() {
        return $this->belongsTo('School');
    }

    public function level(){
        return $this->belongsTo('Level');
    }

}
