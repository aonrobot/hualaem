<?php

class Level extends Eloquent {

    public function semesters() {
        return $this->hasMany('Semester');
    }

    public function childs(){
        return $this->hasMany('Level','parent_id')->orderBy('order');
    }

}
