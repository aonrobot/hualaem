<?php

class Grade extends Eloquent {

    public function semester() {
        return $this->belongsTo('Semester');
    }

}
