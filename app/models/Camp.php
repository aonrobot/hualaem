<?php

class Camp extends Eloquent {

    public function level(){
        return $this->belongsTo('Level');
    }

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

    public function getOpenForRegisterAttribute(){
        $now = date('Y-m-d');
        return ($this->camp_start == null || $this->camp_start >= $now) && $this->register_start <= $now &&
            ($this->register_end == null || $this->register_end >= $now || $this->register_end == '0000-00-00');
    }

    public function scopeOpenForRegisterCamp($query){
        $now = date('Y-m-d');
        $query->where(function($query) use ($now){
            $query->where('camp_start','>=',$now)->orWhere('camp_start','null');
        });
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
