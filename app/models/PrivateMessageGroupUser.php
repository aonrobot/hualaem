<?php

class PrivateMessageGroupUser extends Eloquent {
    use SoftDeletingTrait;

    public function group() {
        return $this->belongsTo('PrivateMessageGroup','group_id');
    }

    public function user() {
        return $this->belongsTo('User');
    }

}
