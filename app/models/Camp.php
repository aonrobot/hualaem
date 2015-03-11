<?php

class Camp extends Eloquent {

    public function fields(){
        return $this->hasMany('CampField');
    }
    
    public function subjects(){
        return $this->hasMany('CampSubject');
    }
    
    public function province() {
        return $this->belongsTo('Province');
    }

    public function enrolls() {
        return $this->hasMany('Enroll');
    }

    public function users() {
        return $this->hasManyThrough('User', 'Enroll');
    }
    
    public function scopeOpenForRegisterCamp($query){
        $now = date('Y-m-d');
        $query->where('register_start','<=',$now);
        $query->where(function($query) use ($now){
            $query->where('register_end','>=',$now);
            $query->orWhere('register_end',null);
            $query->orWhere('register_end','0000-00-00');
        });
    }

    public function getImagePathAttribute($value){
        if(!empty($value)){
            return $value;
        }

        return asset('images/1415577731_handdrawn-lightbulb-48.png');
    }

}
