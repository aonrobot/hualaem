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
        if (Input::hasFile('file_person')) {
            $filePerson = \Input::file('file_person');

            if (!$this->isRightExtension($filePerson->getClientOriginalExtension())) {
                return "Error " . $filePerson->getClientOriginalExtension();
                //TODO: Error
            }
        } else {
            //TODO: Error
            return "ERROR";
        }

        if (Input::hasFile('file_school')) {
            $fileSchool = \Input::file('file_school');

            if (!$this->isRightExtension($fileSchool->getClientOriginalExtension())) {
                return "Error " . $fileSchool->getClientOriginalExtension();
                //TODO: Error
            }
        } else {
            //TODO: Error
            return "ERROR";
        }

        if (Input::hasFile('file_camp')) {
            $fileCamp = \Input::file('file_camp');

            if (!$this->isRightExtension($fileCamp->getClientOriginalExtension())) {
                return "Error " . $fileCamp->getClientOriginalExtension();
                //TODO: Error
            }
        } else {
            //TODO: Error
            return "ERROR";
        }

        $filePerson->move(storage_path('tmp'), 'person.csv');
        $fileSchool->move(storage_path('tmp'), 'school.csv');
        $fileCamp->move(storage_path('tmp'), 'camp.csv');


        return \Redirect::action('mix5003\Hualaem\Backend\ImportUserController@getStep2');
    }

    private function isRightExtension($ext) {
        return strtolower($ext) === 'csv';
    }

    public function getStep2() {
        if (!file_exists(storage_path('tmp/person.csv')) || !file_exists(storage_path('tmp/school.csv')) || !file_exists(storage_path('tmp/camp.csv'))) {
            return \Redirect::action('mix5003\Hualaem\Backend\ImportUserController@getStep1');
        }

        //Fix Thai in csv 
        setlocale(LC_ALL, 'en_US.UTF-8');
        // setlocale ( LC_ALL, 'th_TH.TIS-620' );

        $personCols = $this->getColumnList(storage_path('tmp/person.csv'));
        $schoolCols = $this->getColumnList(storage_path('tmp/school.csv'));
        $campCols = $this->getColumnList(storage_path('tmp/camp.csv'));
        
        $importable = \Config::get('importable.admin_user_import');
        
        $cols = [
            'person'=>$personCols,
            'school'=>$schoolCols,
            'camp'=>$campCols,
        ];
        
        return $this->view('import.user.step2',compact('cols','importable'));
    }

    private function getColumnList($filepath) {
        $fp = fopen($filepath, 'r');
        $cols = fgetcsv($fp, 0, "\t", '"');
        fclose($fp);
        $cols = array_filter($cols);
        return $cols;
    }

    public function postStep2() {
        
    }

}
