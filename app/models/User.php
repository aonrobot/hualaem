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

    protected $appends = array('fullname_th');

    public function getFullnameTHAttribute(){
        return $this->prefix_th.$this->firstname_th.' '.$this->lastname_th;
    }
    
    public function getAgeAttribute(){
        if($this->birthdate == NULL){
            return "";
        }
        
        $birthTime = strtotime($this->birthdate);
        $diffTime = time() - $birthTime;
        
        return intval($diffTime / (3600 *24 *365));
    }

    public function getUnReadAttribute(){
        return $this->notifications()->where('is_read',false)->count();
    }

    public function getUnReadPMAttribute(){
        return $this->privateMessages()->where(function($query){
            $query->whereNull('last_open');
            $query->orWhere(DB::raw('last_open < updated_at'));
        })->count();
    }

    public function currentSchool(){
        return $this->hasOne('Semester')->with('School')->orderBy('year','desc')->take(1);
    }

    public function privateMessages(){
        return $this->hasMany('PrivateMessageGroupUser')->orderBy('updated_at','desc');
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

    public function logs(){
        return $this->hasMany('UserLog');
    }

    public function notifications(){
        return $this->hasMany('Notification')->orderBy('created_at','desc');
    }

}
