<?php


class PrivateMessageGroup extends Eloquent {
    public $timestamps = false;
    
    public function groupUsers(){
        return $this->hasMany('PrivateMessageGroupUser', 'group_id');
    }

    public function datas(){
        return $this->hasMany('PrivateMessageData','group_id')->orderBy('created_at');
    }

    public function sender(){
        return $this->belongsTo('User','starter_id');
    }
}
