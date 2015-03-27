<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Input;

class PrivateMessageController extends FrontendController {
    public function getCreate($to_id){
        $to = \User::findOrFail($to_id);
        return $this->view('pm.form',compact('to'));
    }

    public function postCreate(){
        //TODO:: Validate Input
        $to_id = Input::get('to');
        $to = \User::findOrFail($to_id);

        \DB::transaction(function() use ($to) {


            $pmGroup = new \PrivateMessageGroup();
            $pmGroup->topic = Input::get('title');
            $pmGroup->starter_id = \Auth::user()->id;
            $pmGroup->save();

            $pmData = new \PrivateMessageData();
            $pmData->group_id = $pmGroup->id;
            $pmData->sender_id = \Auth::user()->id;
            $pmData->message = Input::get('message');
            $pmData->save();

            $pmGroupUser = new \PrivateMessageGroupUser();
            $pmGroupUser->user_id = $to->id;
            $pmGroupUser->group_id = $pmGroup->id;
            $pmGroupUser->save();
        });

        return \Redirect::route('user.pm.list')->with('infos',['Create Private Message Successfully.']);
    }

    public function postReply(){
        //TODO:: Validate Input
        $pmGroup_id = Input::get('group');
        $pmGroup = \PrivateMessageGroup::findOrFail($pmGroup_id);

        $to_id = Input::get('to');
        $to = \User::findOrFail($to_id);

        \DB::transaction(function() use ($to,$pmGroup) {

            $pmData = new \PrivateMessageData();
            $pmData->group_id = $pmGroup->id;
            $pmData->sender_id = \Auth::user()->id;
            $pmData->message = Input::get('message');
            $pmData->save();

            $chkQuery = \PrivateMessageGroupUser::where('user_id',$to->id)->where('group_id',$pmGroup->id);
            if(!$chkQuery->exists()) {
                $pmGroupUser = new \PrivateMessageGroupUser();
                $pmGroupUser->user_id = $to->id;
                $pmGroupUser->group_id = $pmGroup->id;
                $pmGroupUser->save();
            }
            $pmGroupUsers = \PrivateMessageGroupUser::where('group_id',$pmGroup->id)->get();
            foreach($pmGroupUsers as $pmGroupUser){
                $pmGroupUser->touch();
            }
        });

        return \Redirect::route('user.pm.list')->with('infos',['Reply Private Message Successfully.']);
    }

    public function getList(){
        $pms = \Auth::user()->privateMessages()->with('group','group.sender')->paginate();

        return $this->view('pm.list',compact('pms'));
    }

    public function getView($group_id){
        $pmGroup = \PrivateMessageGroup::findOrFail($group_id);

        $chkQuery = \PrivateMessageGroupUser::where('group_id',$group_id)->where('user_id',\Auth::user()->id);
        if($chkQuery->exists()){
            $pmGroup->load('datas','datas.sender');

            return $this->view('pm.view',compact('pmGroup'));
        }else{
            return \App::abort(403);
        }
    }
}