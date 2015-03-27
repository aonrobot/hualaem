<?php

class PrivateMessageData extends Eloquent {
    public function group(){
        return $this->belongsTo('PrivateMessageGroup','group_id');
    }
    
    public function sender(){
        return $this->belongsTo('User','sender_id');
    }
}
