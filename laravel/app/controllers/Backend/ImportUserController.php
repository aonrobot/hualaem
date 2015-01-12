<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class ImportUserController extends BackendController {

    public function getIndex() {
        return $this->getStep1();
    }

    public function getStep1() {
        return $this->view('import.user.step1');
    }

    public function postStep1() {
        if(Input::hasFile('file_person')){
            $filePerson = \Input::file('file_person');
            
            if(!$filePerson->getClientOriginalExtension() == 'xlsx'){
                return "Error ".$filePerson->getClientOriginalExtension();
                //TODO: Error
            }
        }else{
            //TODO: Error
            return "ERROR";
        }
        
        if(Input::hasFile('file_school')){
            $fileSchool = \Input::file('file_school');
            
            if(!$fileSchool->getClientOriginalExtension() == 'xlsx'){
                return "Error ".$fileSchool->getClientOriginalExtension();
                //TODO: Error
            }
        }else{
            //TODO: Error
            return "ERROR";
        }
        
        if(Input::hasFile('file_camp')){
            $fileCamp = \Input::file('file_camp');
            
            if(!$fileCamp->getClientOriginalExtension() == 'xlsx'){
                return "Error ".$fileCamp->getClientOriginalExtension();
                //TODO: Error
            }
        }else{
            //TODO: Error
            return "ERROR";
        }
        var_dump($filePerson,$fileSchool,$fileCamp);
        $filePerson->move(storage_path('tmp'),'person.xlsx');
        $fileSchool->move(storage_path('tmp'),'school.xlsx');
        $fileCamp->move(storage_path('tmp'),'camp.xlsx');
        
        return \Redirect::action('mix5003\Hualaem\Backend\ImportUserController@getStep2');
    }
    
    public function getStep2(){
        return $this->view('import.user.step2');
    }

}
