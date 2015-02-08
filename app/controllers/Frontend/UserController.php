<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Input;

class UserController extends FrontendController {
    public function getCalendar(){
        return $this->view('user.calendar');
    }
    
    public function getCalendarData($status){
        $user = \Auth::user();
        $enrolls = $user->enrolls()->where('status',$status)->whereHas('camp',function($q){
            $start = Input::get('start');
            $end = Input::get('end');
            $q->where(function($q) use ($start,$end){
                $q->where('camp_start','>=',$start)->where('camp_start','<=',$end);
            });
            
            $q->orWhere(function($q) use ($start,$end){
                $q->where('camp_end','>=',$start)->where('camp_end','<=',$end);
            });
            
        })->with('camp')->get();
        
        $events = [];
        foreach($enrolls as $enroll){
            $events[] = [
                'title'=>$enroll->camp->name,
                'start'=>$enroll->camp->camp_start,
                'end'=>$enroll->camp->camp_end,
                'url'=>\URL::route('guest.camp.view',$enroll->camp->id),
            ];
        }
        
        return \Response::json($events);
    }
    
}