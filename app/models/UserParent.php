<?php

class UserParent extends Eloquent {

    public function getFullnameTHAttribute(){
        return $this->prefix_th.' '.$this->firstname_th.' '.$this->lastname_th;
    }
    
    public function user() {
        return $this->belongsTo('User');
    }

}
