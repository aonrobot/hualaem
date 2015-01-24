<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class CampController extends BackendController {

    public function getAdd() {
        $allProvinces = \Province::orderBy('name')->get();
        $provinces = [];
        foreach ($allProvinces as $province) {
            $provinces[$province->id] = $province->name;
        }

        return $this->view('camp.add', compact('provinces'));
    }

    public function postAdd() {
        $campRule = [
            'name' => 'required',
            'type' => 'required',
            'level' => 'required',
            'register_start' => 'date',
            'register_end' => 'date',
            'camp_start' => 'date',
            'camp_end' => 'date',
            'province_id' => 'required|exists:provinces,id',
            'image' => 'required|image',
        ];
        $campData = Input::only(['name', 'type', 'level', 'register_start', 'register_end', 'camp_start', 'camp_end', 'place', 'province_id', 'image', 'description']);

        $v = \Validator::make($campData, $campRule);
        if ($v->passes()) {
            $camp = new \Camp();
            unset($campData['image']);
            foreach ($campData as $key => $val) {
                $camp->$key = $val;
            }
            $camp->save();

            //Save Image
            $file = Input::file('image');
            $filename = $camp->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/camps'), $filename);
            $camp->image_path = \URL::to('uploads/camps/' . $filename);
            $camp->save();

            $fields = Input::get('fields');
            foreach ($fields as $fieldData) {
                $field = new \CampField();
                $field->name = $fieldData['name'];
                $field->type = $fieldData['type'];
                $camp->fields()->save($field);
            }
            
            $subjects = Input::get('subjects');
            foreach($subjects as $subjectData){
                $subject = new \CampSubject();
                $subject->name = $subjectData['name'];
                $camp->subjects()->save($subject);
                
                foreach($subjectData['tests'] as $testData){
                    $test = new \CampTest();
                    $test->name = $testData['name'];
                    $subject->tests()->save($test);
                }
            }
            //TODO: Return
            
        } else {
            //TODO: Create Subject and field by my input
            return \Redirect::back()->withInput()->withErrors($v);
        }
    }

}
