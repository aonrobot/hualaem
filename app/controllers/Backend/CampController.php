<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class CampController extends BackendController {

    public function getIndex() {
        $camps = \Camp::orderBy('id', 'desc')->paginate(20);

        return $this->view('camp.list', compact('camps'));
    }

    public function getView($campId) {
        $camp = \Camp::findOrFail($campId);
        $camp->load('enrolls', 'enrolls.user');
        return $this->view('camp.view', compact('camp'));
    }

    public function getAdd() {
        $levels = \Level::where('parent_id',null)->with('childs','childs.childs')->orderBy('order')->get();
        $allProvinces = \Province::orderBy('name')->get();
        $provinces = [];
        foreach ($allProvinces as $province) {
            $provinces[$province->id] = $province->name;
        }
        $camp = new \Camp();
        return $this->view('camp.form', compact('provinces', 'camp','levels'));
    }

    public function postSave($campID = 0) {
        $campRule = [
            'name' => 'required',
            'type' => 'required',
            'level_id' => 'required|exists:levels,id',
            'register_start' => 'date',
            'register_end' => 'date',
            'camp_start' => 'date',
            'camp_end' => 'date',
            'province_id' => 'required|exists:provinces,id',
            'image' => 'image',
        ];
        $campData = Input::only(['name', 'type', 'level_id', 'register_start', 'register_end', 'camp_start', 'camp_end', 'place', 'province_id', 'image', 'description']);

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

            $allIDs = \CampField::where('camp_id',$camp->id)->get(['id'])->fetch('id')->toArray();
            $foundIDs = [];
            $fields = Input::get('fields');
            if (!empty($fields)) {
                foreach ($fields as $fieldData) {
                    if (empty($fieldData['id'])) {
                        $field = new \CampField();
                    } else {
                        $field = \CampField::find($fieldData['id']);
                        $foundIDs[] = $fieldData['id'];
                    }
                    $field->camp_id = $camp->id;
                    $field->name = $fieldData['name'];
                    $field->type = $fieldData['type'];
                    $field->is_required = isset($fieldData['is_required']);
                    $field->save();
                }
            }

            $deleteField = array_diff($allIDs, $foundIDs);
            if(!empty($deleteField)){
                \CampField::whereIn('id',$deleteField)->delete();
            }


            $allSubjectIds = \CampSubject::where('camp_id',$camp->id)->get(['id'])->fetch('id')->toArray();
            $foundSubjectIds = [];
            $subjects = Input::get('subjects');
            if (!empty($subjects)) {
                foreach ($subjects as $subjectData) {
                    if (empty($subjectData['id'])) {
                        $subject = new \CampSubject();
                    } else {
                        $subject = \CampSubject::find($subjectData['id']);
                        $foundSubjectIds[] = $subjectData['id'];
                    }
                    $subject->camp_id = $camp->id;
                    $subject->name = $subjectData['name'];
                    $subject->save();

                    if (empty($subjectData['tests'])) {
                        \CampTest::where('camp_subject_id',$subject->id)->delete();
                        continue;
                    }

                    $allTestIds = \CampTest::where('camp_subject_id',$subject->id)->get(['id'])->fetch('id')->toArray();
                    $foundTestIds = [];
                    foreach ($subjectData['tests'] as $testData) {
                        if (empty($testData['id'])) {
                            $test = new \CampTest();
                        } else {
                            $test = \CampTest::find($testData['id']);
                            $foundTestIds[] = $testData['id'];
                        }
                        $test->camp_subject_id = $subject->id;
                        $test->name = $testData['name'];
                        $test->save();
                    }
                    $deleteTest = array_diff($allTestIds, $foundTestIds);
                    if(!empty($deleteTest)){
                        \CampTest::whereIn('id',$deleteTest)->delete();
                    }
                }
            }
            $deleteSubject = array_diff($allSubjectIds, $foundSubjectIds);
            if(!empty($deleteSubject)){
                \CampSubject::whereIn('id',$deleteSubject)->delete();
            }

            return \Redirect::route('admin.camp.list');
        } else {
            //TODO: Create Subject and field by my input
            return \Redirect::back()->withInput()->withErrors($v);
        }
    }

    public function getEdit($campID) {
        $levels = \Level::where('parent_id',null)->with('childs','childs.childs')->orderBy('order')->get();
        $allProvinces = \Province::orderBy('name')->get();
        $provinces = [];
        foreach ($allProvinces as $province) {
            $provinces[$province->id] = $province->name;
        }

        $camp = \Camp::find($campID);
        $camp->load(['fields', 'subjects', 'subjects.tests']);

        return $this->view('camp.form', compact('provinces', 'camp','levels'));
    }

    public function getApplication($campID) {
        $camp = \Camp::find($campID);
        $camp->load('enrolls', 'enrolls.user');

        return $this->view('camp.application', compact('camp'));
    }

    public function postApplication() {
        //TODO:: Add Notification
        if (Input::has('action')) {
            switch(Input::get('action')){
                case 'Approved':
                    $setTo = \Enroll::STATUS_APPROVED;
                    break;
                case 'Received':
                    $setTo = \Enroll::STATUS_DOCUMENT_RECIEVED;
                    break;
                case 'Unapproved':
                    $setTo = \Enroll::STATUS_PENDING;
                    break;
            }
            \DB::table((new \Enroll())->getTable())->whereIn('id', Input::get('selected', [0]))->update(['status' => $setTo]);
        } elseif (Input::has('approve')) {
            $enroll = \Enroll::findOrFail(Input::get('approve'));
            $enroll->status = \Enroll::STATUS_APPROVED;
            $enroll->save();
        } elseif (Input::has('received')) {
            $enroll = \Enroll::findOrFail(Input::get('received'));
            $enroll->status = \Enroll::STATUS_DOCUMENT_RECIEVED;
            $enroll->save();
        } elseif (Input::has('unapprove')) {
            $enroll = \Enroll::findOrFail(Input::get('unapprove'));
            $enroll->status = \Enroll::STATUS_DOCUMENT_RECIEVED;
            $enroll->save();
        } elseif (Input::has('delete')) {
            $enroll = \Enroll::findOrFail(Input::get('delete'));
            $enroll->delete();
        }
        return \Redirect::back();
    }

    public function getAjaxCampField($enrollID) {
        $enroll = \Enroll::findOrFail($enrollID);
        $enroll->load('fields', 'fields.campFields');

        return $this->view('ajax.camp_fields', [
                    'fields' => $enroll->fields
        ]);
    }

    public function getDownloadApplicationFile($enrollFieldId) {
        $field = \EnrollField::findOrFail($enrollFieldId);
        if ($field->campFields->type != \CampField::FILE) {
            return \App::abort(404);
        }
        $fileData = json_decode($field->value);
        $ext = substr($fileData->file_name, strrpos($fileData->file_name, '.'));
        $filePath = storage_path('enroll_fields/' . $field->enroll_id . '_' . $field->campFields->id . $ext);

        return \Response::download($filePath, $fileData->file_name);
    }

    public function getScore($enrollID) {
        $enroll = \Enroll::findOrFail($enrollID);
        $camp = $enroll->camp;

        $camp->load('subjects', 'subjects.tests');

        $scored = [];
        foreach ($enroll->scores as $score) {
            $scored[$score->camp_test_id] = $score;
        }

        return $this->view('camp.score', compact('enroll', 'camp', 'scored'));
    }

    public function postScore($enrollID) {
        $enroll = \Enroll::findOrFail($enrollID);
        $camp = $enroll->camp;

        $camp->load('subjects', 'subjects.tests');

        $scored = [];
        foreach ($enroll->scores as $score) {
            $scored[$score->camp_test_id] = $score;
        }

        $scores = Input::get('scores');
        if (!empty($scores)) {
            foreach ($scores as $testID => $score) {
                if(isset($scored[$testID])){
                    $score_obj = $scored[$testID];
                }else{
                    if(empty($score)) { 
                        continue;
                    }
                    $score_obj = new \EnrollScore();
                    $score_obj->enroll_id = $enrollID;
                    $score_obj->camp_test_id = $testID;
                }
                $score_obj->score = $score;
                
                $score_obj->save();
            }
        }

        return \Redirect::route('admin.camp.view',[$camp->id]);
    }

    public function getCampScore($campId){
        $camp = \Camp::findOrFail($campId);
        $camp->load('enrolls','enrolls.user','enrolls.scores','subjects', 'subjects.tests');
        
        $scored = [];
        foreach($camp->enrolls as $enroll){
            foreach($enroll->scores as $score){
                $scored[$enroll->id][$score->camp_test_id] = $score->score;
            }
        }
        
        return $this->view('camp.camp_score',compact('camp','scored'));
    }
    
    public function postCampScore($campId){
        $inpScored = Input::get('scored');
        $camp = \Camp::findOrFail($campId);
        $camp->load('enrolls','enrolls.scores');
        
        $scored = [];
        foreach($camp->enrolls as $enroll){
            foreach($enroll->scores as $score){
                $scored[$enroll->id][$score->camp_test_id] = $score;
            }
        }
        
        if(!empty($inpScored)){
            foreach ($inpScored as $enrollID => $scores) {
                foreach($scores as $testID => $score){
                    if(isset($scored[$enrollID][$testID])){
                        $score_obj = $scored[$enrollID][$testID];
                    }else{
                        if(empty($score)) { 
                            continue;
                        }
                        $score_obj = new \EnrollScore();
                        $score_obj->enroll_id = $enrollID;
                        $score_obj->camp_test_id = $testID;
                    }
                    $score_obj->score = $score;

                    $score_obj->save();
                }
            }
        }
        
        return \Redirect::route('admin.camp.camp_score',[$campId]);
    }
}
