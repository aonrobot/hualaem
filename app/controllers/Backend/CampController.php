<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class CampController extends BackendController {
    
    public function getIndex(){
        $camps = \Camp::orderBy('id','desc')->paginate(15);
        
        return $this->view('camp.list',compact('camps'));
    }

    public function getAdd() {
        $allProvinces = \Province::orderBy('name')->get();
        $provinces = [];
        foreach ($allProvinces as $province) {
            $provinces[$province->id] = $province->name;
        }
        $camp = new \Camp();
        return $this->view('camp.form', compact('provinces','camp'));
    }

    public function postSave($campID = 0) {
        $campRule = [
            'name' => 'required',
            'type' => 'required',
            'level' => 'required',
            'register_start' => 'date',
            'register_end' => 'date',
            'camp_start' => 'date',
            'camp_end' => 'date',
            'province_id' => 'required|exists:provinces,id',
            'image' => 'image',
        ];
        $campData = Input::only(['name', 'type', 'level', 'register_start', 'register_end', 'camp_start', 'camp_end', 'place', 'province_id', 'image', 'description']);

        $v = \Validator::make($campData, $campRule);
        if ($v->passes()) {
            if (empty($campID)) {
                $camp = new \Camp();
            } else {
                $camp = \Camp::find($campID);
            }
            unset($campData['image']);

            foreach ($campData as $key => $val) {
                $camp->$key = $val;
            }
            $camp->save();

            //Save Image
            if (Input::hasFile('image')) {
                $file = Input::file('image');
                $filename = $camp->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/camps'), $filename);
                $camp->image_path = \URL::to('uploads/camps/' . $filename);
                $camp->save();
            }
            

            $fields = Input::get('fields');
            if(!empty($fields)){
                foreach ($fields as $fieldData) {
                    if (empty($fieldData['id'])) {
                        $field = new \CampField();
                    } else {
                        $field = \CampField::find($fieldData['id']);
                    }
                    $field->camp_id = $camp->id;
                    $field->name = $fieldData['name'];
                    $field->type = $fieldData['type'];
                    $field->is_required = isset($fieldData['is_required']);
                    $field->save();
                }
            }
            
            $subjects = Input::get('subjects');
            if(!empty($subjects)){
                foreach ($subjects as $subjectData) {
                    if (empty($subjectData['id'])) {
                        $subject = new \CampSubject();
                    } else {
                        $subject = \CampSubject::find($subjectData['id']);
                    }
                    $subject->camp_id = $camp->id;
                    $subject->name = $subjectData['name'];
                    $subject->save();

                    if(empty($subjectData['tests'])) continue;

                    foreach ($subjectData['tests'] as $testData) {
                        if (empty($testData['id'])) {
                            $test = new \CampTest();
                        } else {
                            $test = \CampTest::find($testData['id']);
                        }
                        $test->camp_subject_id = $subject->id;
                        $test->name = $testData['name'];
                        $test->save();
                    }
                }
            }
            //TODO: Return
        } else {
            //TODO: Create Subject and field by my input
            return \Redirect::back()->withInput()->withErrors($v);
        }

    }

    public function getEdit($campID) {
        $allProvinces = \Province::orderBy('name')->get();
        $provinces = [];
        foreach ($allProvinces as $province) {
            $provinces[$province->id] = $province->name;
        }

        $camp = \Camp::find($campID);
        $camp->load(['fields', 'subjects', 'subjects.tests']);

        return $this->view('camp.form', compact('provinces', 'camp'));
    }

    public function getApplication($campID){
        $camp = \Camp::find($campID);
        $camp->load('enrolls','enrolls.user');
        
        return $this->view('camp.application',compact('camp'));
    }
    
    public function postApplication($campID){
        //TODO:: Add Notification
        if(Input::has('action')){
            $setTo = Input::get('action') =='Approved' ? \Enroll::STATUS_APPROVED : \Enroll::STATUS_PENDING;
            \DB::table((new \Enroll())->getTable())->whereIn('id', Input::get('selected',[0]))->update(['status'=>$setTo]);
        }elseif(Input::has('approve')){
            $enroll = \Enroll::findOrFail(Input::get('approve'));
            $enroll->status = \Enroll::STATUS_APPROVED;
            $enroll->save();
        }elseif(Input::has('unapprove')){
            $enroll = \Enroll::findOrFail(Input::get('unapprove'));
            $enroll->status = \Enroll::STATUS_PENDING;
            $enroll->save();
        }
        return \Redirect::back();
    }
}
