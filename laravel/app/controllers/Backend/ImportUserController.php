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
            'person' => $personCols,
            'school' => $schoolCols,
            'camp' => $campCols,
        ];

        return $this->view('import.user.step2', compact('cols', 'importable'));
    }

    private function getCSVRow($fp) {
        $cols = fgetcsv($fp, 0, "\t", '"');
        return $cols;
    }

    private function getColumnList($filepath) {
        $fp = fopen($filepath, 'r');
        $cols = $this->getCSVRow($fp);
        fclose($fp);
        return array_filter($cols);
    }

    public function postStep2() {
        \Session::set('import_data', Input::all());
        return $this->getStep3();
        //return \Redirect::action('mix5003\Hualaem\Backend\ImportUserController@getStep3');
    }

    public function getStep3() {
        //Not Import 
        //Camp: Level, Search & Writing,Ed.Yr.,ข้อเขียน
        //TODO: Import Level
        //TODO: Import ข้อเขียน

        $limitRow = 10;
        $data = \Session::get('import_data');
        $importable = \Config::get('importable.admin_user_import');

        $previewData = [];
        $headerData = [];
        foreach ($importable as $keyType => $types) {
            //Cache 10 Rows
            $cacheTable = [];
            $fp = fopen(storage_path('tmp/' . $keyType . '.csv'),'r');
            $this->getCSVRow($fp);
            for ($i = 0; $i < $limitRow; $i++) {
                $cacheTable[] = $this->getCSVRow($fp);
            }
            fclose($fp);
            
            foreach ($types as $type => $fields) {
                $table = [];
                for ($i = 0; $i < $limitRow; $i++) {
                    $row = [];
                    
                    foreach ($fields as $field => $label) {
                        if(!empty($data[$type][$field])){
                            $row[$field] = $cacheTable[$i][$data[$type][$field]];
                        }else{
                            $row[$field] = null;
                        }
                        
                    }
                    $table[] = $row;
                }
                $headerData[$type] = $fields;
                $previewData[$type] = $table;
            }
            
        }
        
        return $this->view('import.user.step3',compact('previewData','importable'));
    }

}
