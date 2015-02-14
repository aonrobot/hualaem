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


        return \Redirect::route('admin.import.step2');
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
        if (isset($cols[0])) {
            foreach ($cols as $key => $val) {
                $cols[$key] = trim($val);
            }
        }
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

        return \Redirect::route('admin.import.step3');
    }

    public function getStep3() {

        $limitRow = 10;
        $data = \Session::get('import_data');
        $importable = \Config::get('importable.admin_user_import');

        $previewData = [];
        $headerData = [];
        foreach ($importable as $keyType => $types) {
            //Cache 10 Rows
            $cacheTable = [];
            $fp = fopen(storage_path('tmp/' . $keyType . '.csv'), 'r');
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
                        if (!empty($data[$type][$field])) {
                            $row[$field] = $cacheTable[$i][$data[$type][$field]];
                        } else {
                            $row[$field] = null;
                        }
                    }
                    $table[] = $row;
                }
                $headerData[$type] = $fields;
                $previewData[$type] = $table;
            }
        }

        return $this->view('import.user.step3', compact('previewData', 'importable'));
    }

    public function postStep3() {
        //Not Import 
        //Camp: Search & Writing,Ed.Yr.,ข้อเขียน
        //TODO: Import ข้อเขียน

        \DB::transaction(function() {
            \Cache::flush();
            \Cache::setPrefix('import_' . time());

            $originData = \Session::get('import_data');
            $importable = \Config::get('importable.admin_user_import');

            $provinces = [];
            foreach (\Province::all() as $province) {
                $provinces[$province->name] = $province->id;
            }

            $districts = [];
            foreach (\District::all() as $district) {
                $districts[$district->name] = $district->id;
            }

            $subDistricts = [];
            foreach (\SubDistrict::all() as $subDistrict) {
                $subDistricts[$subDistrict->name] = $subDistrict->id;
            }

            foreach ($importable as $keyType => $types) {
                foreach ($types as $type => $fields) {
                    $fp = fopen(storage_path('tmp/' . $keyType . '.csv'), 'r');
                    $this->getCSVRow($fp);
                    while ($csvRow = $this->getCSVRow($fp)) {
                        $data = $originData;

                        if ($type == 'users') {
                            $obj = new \User();
                            $obj->student_id = $csvRow[0];
                            $obj->role = \User::VERIFIED;
                            $csvRow[$data[$type]['citizen_id']] = str_replace(array('-', ' '), '', $csvRow[$data[$type]['citizen_id']]);
                            $csvRow[$data[$type]['mobile_no']] = str_replace(array('-', ' '), '', $csvRow[$data[$type]['mobile_no']]);
                            $csvRow[$data[$type]['birthdate']] = $this->reformatDate(trim($csvRow[$data[$type]['birthdate']]));
                            $csvRow[$data[$type]['created_at']] = $this->reformatDate(trim($csvRow[$data[$type]['created_at']]));
                            
                        } elseif ($type == 'addresses') {
                            $obj = new \Address();
                            $obj->user_id = \Cache::get('user_' . $csvRow[0]);


                            if (!empty($provinces[$csvRow[$data[$type]['province']]])) {
                                $obj->province_id = $provinces[$csvRow[$data[$type]['province']]];
                            }
                            if (!empty($districts[$csvRow[$data[$type]['district']]])) {
                                $obj->district_id = $districts[$csvRow[$data[$type]['district']]];
                            }
                            if (!empty($districts[$csvRow[$data[$type]['sub_district']]])) {
                                $obj->sub_district_id = $districts[$csvRow[$data[$type]['sub_district']]];
                            }

                            unset($data[$type]['province']);
                            unset($data[$type]['district']);
                            unset($data[$type]['sub_district']);
                        } elseif ($type == 'mother' || $type == 'father') {
                            if (empty($csvRow[$originData[$type]['firstname_th']])) {
                                continue;
                            }
                            $csvRow[$data[$type]['mobile_no']] = str_replace(array('-', ' '), '', $csvRow[$data[$type]['mobile_no']]);
                            $obj = new \UserParent();
                            $obj->user_id = \Cache::get('user_' . $csvRow[0]);
                            if ($type == 'father') {
                                $obj->relation = 'พ่อ';
                            } else {
                                $obj->relation = 'แม่';
                            }
                        } elseif ($type == 'school') {
                            if (\Cache::has('school_' . $csvRow[$data[$type]['name']])) {
                                continue;
                            }
                            $obj = new \School();
                        } elseif ($type == 'semester') {
                            $obj = new \Semester();
                            $obj->user_id = \Cache::get('user_' . $csvRow[0]);
                            $obj->school_id = \Cache::get('school_' . $csvRow[$data[$type]['name']]);

                            if (empty($obj->user_id)) {
                                //TODO: i guess data not same source
                                continue;
                            }

                            unset($data[$type]['name']);
                        } elseif ($type == 'camp') {

                            if (\Cache::has('camp_' . $csvRow[$data[$type]['name']])) {
                                if (!\Cache::has('user_' . $csvRow[0])) {
                                    //TODO: i guess data not same source
                                    continue;
                                }
                                $enroll = new \Enroll();
                                $enroll->user_id = \Cache::get('user_' . $csvRow[0]);
                                $enroll->camp_id = \Cache::get('camp_' . $csvRow[$data[$type]['name']]);
                                $enroll->status = \Enroll::STATUS_APPROVED;
                                $enroll->role = $csvRow[$originData[$type]['role']] == 'ผู้เรียน' ? \Enroll::ROLE_STUDENT : \Enroll::ROLE_STAFF;
                                $enroll->save();

                                continue;
                            }
                            $obj = new \Camp();
                            $startDate = $csvRow[$data[$type]['camp_start']];
                            if (strpos($startDate, '-') !== false) {
                                $arr = explode('-', $startDate);
                                $csvRow[$data[$type]['camp_start']] = $this->reformatDate(trim($arr[0]));
                                $obj->camp_end = $this->reformatDate(trim($arr[1]));
                            } else {
                                $csvRow[$data[$type]['camp_start']] = $this->reformatDate(trim($startDate));
                            }

                            unset($data[$type]['role']);

                            if (!empty($provinces[$csvRow[$data[$type]['province']]])) {
                                $obj->province_id = $provinces[$csvRow[$data[$type]['province']]];
                            }

                            unset($data[$type]['province']);
                        }

                        foreach ($fields as $field => $label) {
                            if (!empty($data[$type][$field])) {
                                $obj->$field = $csvRow[$data[$type][$field]];
                            }
                        }

                        $obj->save();


                        if ($type == 'users') {
                            \Cache::put('user_' . $csvRow[0], $obj->id, 30);
                        } elseif ($type == 'school') {
                            \Cache::put('school_' . $obj->name, $obj->id, 30);
                        } elseif ($type == 'camp') {
                            \Cache::put('camp_' . $obj->name, $obj->id, 30);

                            if (!\Cache::has('user_' . $csvRow[0])) {
                                //TODO: i guess data not same source
                                continue;
                            }
                            $enroll = new \Enroll();
                            $enroll->user_id = \Cache::get('user_' . $csvRow[0]);
                            $enroll->camp_id = $obj->id;
                            $enroll->status = \Enroll::STATUS_APPROVED;
                            $enroll->role = $csvRow[$originData[$type]['role']] == 'ผู้เรียน' ? \Enroll::ROLE_STUDENT : \Enroll::ROLE_STAFF;
                            $enroll->save();
                        }
                    }
                    fclose($fp);
                }
            }
            \Cache::flush();
        });
        return $this->view('import.user.step1');
    }

    private function reformatDate($str) {
        $arr = explode('/', $str);
        if (count($arr) != 3) {
            $arr = explode('-', $str);
        }
        if (count($arr) != 3) {
            return null;
        }
        return (intval($arr[0]) - 543) . '-' . $arr[1] . '-' . $arr[2];
    }

}
