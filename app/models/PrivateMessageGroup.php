<?php


class PrivateMessageGroup extends Eloquent {
    public $timestamps = false;
    
    public function groupUsers(){
        return $this->hasMany('PrivateMessageGroupUser', 'group_id');
    }
    
    public function sender(){
        return $this->belongsTo('User','starter_id');
    }
}
