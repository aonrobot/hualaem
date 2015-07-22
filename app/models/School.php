<?php

class School extends Eloquent {
    public function semesters() {
        return $this->hasMany('Semester');
    }
}
