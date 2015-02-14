<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class UserController extends BackendController {
    public function getIndex(){
        $users = \User::orderBy('id','desc')->paginate();
        
        return $this->view('user.list',  compact('users'));
    }
    
    public function getView($userID){
        $user = \User::findOrFail($userID);
        $user->load('addresses','parents');
        
        $registerCamps = $user->enrolls()->with('camp')->whereHas('camp', function($q){
            $q->where('camp_end','>=',date('Y-m-d'));
        })->get();
        
        $historyCamps = $user->enrolls()->with('camp')->whereHas('camp', function($q){
            $q->where('camp_end','<',date('Y-m-d'));
        })->take(10)->orderBy('id')->get();
        
        return $this->view('user.view_profile',compact('user','registerCamps','historyCamps'));
    }
}
