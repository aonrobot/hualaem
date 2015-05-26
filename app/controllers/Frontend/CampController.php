<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Input;

class CampController extends FrontendController {
    
    public function getIndex(){
        $camps = \Camp::openForRegisterCamp()->orderBy('camp_end')->paginate(20);
        
        return $this->view('camp.list',compact('camps'));
    }
    
    public function getView($campId){
        $camp = \Camp::findOrFail($campId);

        if(\Auth::check()){
            $enroll = \Auth::user()-> enrolls()->where('camp_id',$campId)->first();

        }
        
        return $this->view('camp.view',compact('camp','enroll'));
    }

    public function getRegister($campID) {
        try {
            $camp = \Camp::openForRegisterCamp()->where('id', $campID)->firstOrFail();
        } catch (\Exception $e) {
            return \Redirect::route('guest.register')->withErrors(['camp-register' => 'Camp not open for register.']);
        }

        $existsEnroll = \Enroll::where('user_id', \Auth::user()->id)->where('camp_id', $campID);
        if ($existsEnroll->exists()) {
            return \Redirect::route('guest.camp.view',[$campID])->withErrors(['camp-register' => 'Already Registered.']);
        }

        return $this->view('camp.register', compact('camp'));
    }

    public function postRegister($campID) {
        try {
            $camp = \Camp::openForRegisterCamp()->where('id', $campID)->firstOrFail();
        } catch (\Exception $e) {
            return \Redirect::route('guest.camp.view',[$campID])->withErrors(['camp-register' => 'Camp not open for register.']);
        }

        $existsEnroll = \Enroll::where('user_id', \Auth::user()->id)->where('camp_id', $campID);
        if ($existsEnroll->exists()) {
            return \Redirect::route('guest.camp.view',[$campID])->withErrors(['camp-register' => 'Already Registered.']);
        }

        $rules = [];
        $messages = [];
        foreach ($camp->fields as $field) {
            if ($field->is_required) {
                $rules['field_' . $field->id] = 'required';
                $messages['field_' . $field->id . '.required'] = 'The ' . $field->name . ' field is required.';
            }
        }

        $v = \Validator::make(Input::all(), $rules, $messages);
        if ($v->passes()) {
            $enroll = new \Enroll();
            $enroll->user_id = \Auth::user()->id;
            $camp->enrolls()->save($enroll);

            foreach ($camp->fields as $field) {
                $enrollField = new \EnrollField();
                $enrollField->camp_fields_id = $field->id;
                if ($field->type == \CampField::TEXT || $field->type == \CampField::TEXTAREA) {
                    $enrollField->value = Input::get('field_' . $field->id);
                } else {
                    $file = Input::file('field_' . $field->id);
                    $newName = $enroll->id . '_' . $field->id . '.' . $file->getClientOriginalExtension();
                    $enrollField->value = json_encode([
                        'file_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType()
                    ]);
                    $file->move(storage_path('enroll_fields'), $newName);
                }
                $enroll->fields()->save($enrollField);
            }
            return \Redirect::route('guest.camp.view',[$campID])->with('infos',['Register Succesfully']);
        } else {
            return \Redirect::route('student.camp.register', [$campID])->withInput()->withErrors($v);
        }
    }

}
