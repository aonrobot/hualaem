<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Input;
use Carbon\Carbon;

class CampController extends FrontendController {

    private function getOpenForRegisterCamp($campID) {
        $camp = \Camp::findOrFail($campID);


        if ($camp->register_start == null || $camp->register_start == '0000-00-00') {
            $startDate = Carbon::yesterday();
        } else {
            $startDate = Carbon::parse($camp->register_start);
        }

        if ($camp->register_end == null || $camp->register_end == '0000-00-00') {
            $endDate = Carbon::tomorrow();
        } else {
            $endDate = Carbon::parse($camp->register_end)->tomorrow();
        }

        if (!Carbon::now()->between($startDate, $endDate)) {
            throw new \Exception();
        }
        return $camp;
    }

    public function getRegister($campID) {
        try {
            $camp = $this->getOpenForRegisterCamp($campID);
        } catch (\Exception $e) {
            //TODO: Redirect to camp list with error
            return \Redirect::route('guest.register')->withErrors(['camp-register' => 'Camp not open for register.']);
            //throw $e;
        }
        return $this->view('camp.register', compact('camp'));
    }

    public function postRegister($campID) {
        try {
            $camp = $this->getOpenForRegisterCamp($campID);
        } catch (\Exception $e) {
            //TODO: Redirect to camp list with error
            return \Redirect::route('guest.register')->withErrors(['camp-register' => 'Camp not open for register.']);
            //throw $e;
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
                $enrollField->camp_field_id = $field->id;
                if ($field->type == 'text' || $field->type == 'textarea') {
                    $enrollField->value = Input::get('field_' . $field->id);
                } else {
                    $file = Input::file('field_' . $field->id);
                    $newName = $enroll->id.'_'.$field->id.'.'.$file->getClientOriginalExtension();
                    $file->move(storage_path('enroll_fields'),$newName);
                    $enrollField->value = $file->getClientOriginalName();
                }
                $enroll->fields()->save($enrollField);
            }
            
            //TODO: Redirect To somewhere
        } else {
            return \Redirect::route('student.camp.register', [$campID])->withInput()->withErrors($v);
        }
    }

}
