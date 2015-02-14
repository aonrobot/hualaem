<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    const UNVERIFY = "UNVERIFY";
    const VERIFIED = "VERIFIED";
    const ADMIN = "ADMIN";
    
    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function getFullNameTHAttribute(){
        return $this->prefix_th.' '.$this->firstname_th.' '.$this->lastname_th;
    }
    
    public function addresses() {
        return $this->hasMany('Address');
    }

    public function parents() {
        return $this->hasMany('UserParent');
    }

    public function semesters() {
        return $this->hasMany('Semester');
    }

    public function enrolls() {
        return $this->hasMany('Enroll');
    }

    public function camps() {
        return $this->hasManyThrough('Camp', 'Enroll');
    }

}
