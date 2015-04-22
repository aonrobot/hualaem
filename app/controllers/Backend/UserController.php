<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class UserController extends BackendController {

    public function getIndex() {
        $query = \User::orderBy('id', 'desc');
        if (Input::has('txtSearchUser')) {
            $query->where(function($query) {
                $word = '%' . Input::get('txtSearchUser') . '%';
                $query->where('firstname_th', 'like', $word);
                $query->orWhere('lastname_th', 'like', $word);
                $query->orWhere('username', 'like', $word);
            });
        }
        if (Input::has('txtSearchDate')) {
            $time = strtotime(Input::get('txtSearchDate'));
            $tomorrowTime = strtotime('tomorrow', $time);

            $query->where('created_at', '>=', Input::get('txtSearchDate'));
            $query->where('created_at', '<', date('Y-m-d', $tomorrowTime));
        }
        $users = $query->paginate();

        return $this->view('user.list', compact('users'));
    }

    public function postMassUpdateUser() {
        $action = Input::get('action');
        $users = \User::whereIn('id', Input::get('selects'))->get();
        if ($action == 'VERIFIED') {
            foreach ($users as $user) {
                if ($user->role == 'ADMIN') {
                    continue;
                }
                $user->role = 'VERIFIED';
                if (empty($user->student_id)) {
                    $user->student_id = \User::max('student_id') + 1;
                }
                $user->save();
            }
        } elseif ($action == 'UNVERIFIED') {
            foreach ($users as $user) {
                if ($user->role == 'ADMIN') {
                    continue;
                }
                $user->role = 'UNVERIFY';
                $user->save();
            }
        }

        return \Redirect::back();
    }

    public function getView($userID) {
        // Duplicate with Frontend/UserController/getProfile

        $user = \User::findOrFail($userID);
        $user->load('addresses', 'parents', 'addresses.subDistrict', 'addresses.district', 'addresses.province');

        $registerCamps = $user->enrolls()->with('camp')->whereHas('camp', function($q) {
                    $q->where('camp_end', '>=', date('Y-m-d'));
                })->get();

        $historyCamps = $user->enrolls()->with('camp')->whereHas('camp', function($q) {
                    $q->where('camp_end', '<', date('Y-m-d'));
                })->take(10)->orderBy('id')->get();

        $userLogs = $user->logs()->orderBy('id', 'desc')->limit(20)->get();

        return $this->view('user.view', compact('user', 'registerCamps', 'historyCamps', 'userLogs'));
    }

    private function flatLastLevel($parent)
    {
        $ret = [];
        if (!isset($parent->childs[0])) {
            $ret[] = $parent;
        } else {
            foreach ($parent->childs as $child) {
                if (!isset($child->childs[0])) {
                    $ret[] = $child;
                }else{
                    $ret = array_merge($ret,$this->flatLastLevel($child));
                }
            }
        }
        return $ret;
    }

    public function getEdit($userID) {
        $user = \User::findOrFail($userID);
        $user->load('addresses', 'parents');

        $lastLevel = [];
        foreach(\Level::where('parent_id',null)->with('childs','childs.childs','childs.childs.childs')->get() as $level){
            $lastLevel = array_merge($lastLevel,$this->flatLastLevel($level));
        }

        $semesters = $user->semesters()->join('levels','semesters.level_id' ,'=','levels.id')->orderBy('levels.order','desc')->select('semesters.*')->get();
        $semesters->load('level','school');

        $allProvinces = \Province::orderBy('name')->get();
        $provinces = [];
        foreach ($allProvinces as $province) {
            $provinces[$province->id] = $province->name;
        }
        $allDistricts = \District::orderBy('name')->get();
        $districts = [];
        foreach ($allDistricts as $district) {
            $districts[] = [
                'id' => $district->id,
                'name' => $district->name,
                'parent_id' => $district->province_id,
            ];
        }

        $allSubDistricts = \SubDistrict::orderBy('name')->get();
        $subDistricts = [];
        foreach ($allSubDistricts as $subDistrict) {
            $subDistricts[] = [
                'id' => $subDistrict->id,
                'name' => $subDistrict->name,
                'parent_id' => $subDistrict->district_id,
            ];
        }

        return $this->view('user.edit', compact('user', 'provinces', 'districts', 'subDistricts','semesters','lastLevel'));
    }

    public function postEdit($userID) {
        $user = \User::findOrFail($userID);
        //TODO: validate input

        $this->saveUser($user);
        $this->saveAddress($user);
        $this->saveParent($user);
        $this->saveSemester($user);

        return \Redirect::route('admin.user.view', [$user->id]);
    }

    private function saveUser($user) {
        $userForm = Input::get('user');
        $insUserForm = array_only($userForm, ['prefix_th','firstname_th', 'lastname_th', 'nickname', 'birthdate', 'mobile_no', 'email', 'citizen_id']);
        foreach ($insUserForm as $key => $val) {
            if (empty($val)) {
                continue;
            }
            if ($user->$key != $val) {
                $log = new \UserLog();
                $log->user_id = \Auth::user()->id;
                $log->target_type = 'PROFILE';
                $log->target_id = $user->id;
                $log->field = $key;
                $log->old_value = $user->$key;
                $log->new_value = $val;
                $log->save();

                $user->$key = $val;
            }
        }
        $user->save();
    }

    private function saveAddress($user) {
        $addressForm = Input::get('address');
        if (empty($addressForm)) {
            return;
        }
        $insAddressField = ['name', 'house_no', 'road', 'village_no', 'village', 'sub_district_id', 'district_id', 'province_id', 'postcode', 'phone_no'];
        foreach ($addressForm as $address) {
            if (!empty($address['id'])) {
                $obj = \Address::find($address['id']);
            } else {
                if (empty($address['name'])) {
                    continue;
                }
                $obj = new \Address;
                $obj->user_id = $user->id;
            }

            if ($obj->user_id != $user->id) {
                continue;
            }

            if (!empty($address['delete'])) {
                $obj->delete();
                continue;
            }

            foreach ($insAddressField as $key) {
                if (empty($address[$key])) {
                    continue;
                }
                if (!empty($address['id']) && $obj->$key != $address[$key]) {
                    $log = new \UserLog();
                    $log->user_id = \Auth::user()->id;
                    $log->target_type = 'ADDRESS';
                    $log->target_id = $address['id'];
                    $log->field = $key;
                    $log->old_value = $obj->$key;
                    $log->new_value = $address[$key];
                    $log->save();
                }
                $obj->$key = $address[$key];
            }
            $obj->save();
        }
    }

    private function saveParent($user) {
        $parentForm = Input::get('parent');
        if (empty($parentForm)) {
            return;
        }
        $insParentField = ['firstname_th', 'lastname_th', 'mobile_no', 'job', 'job_title', 'job_type'];
        foreach ($parentForm as $parent) {
            if (!empty($parent['id'])) {
                $obj = \UserParent::find($parent['id']);
            } else {
                if (empty($parent['relation'])) {
                    continue;
                }
                $obj = new \UserParent;
                $obj->user_id = $user->id;
                $obj->relation = $parent['relation'];
            }

            if ($obj->user_id != $user->id) {
                continue;
            }

            if (!empty($parent['delete'])) {
                $obj->delete();
                continue;
            }

            foreach ($insParentField as $key) {
                if (empty($parent[$key])) {
                    continue;
                }
                if (!empty($parent['id']) && $obj->$key != $parent[$key]) {
                    $log = new \UserLog();
                    $log->user_id = \Auth::user()->id;
                    $log->target_type = 'PARENT';
                    $log->target_id = $parent['id'];
                    $log->field = $key;
                    $log->old_value = $obj->$key;
                    $log->new_value = $parent[$key];
                    $log->save();
                }
                $obj->$key = $parent[$key];
            }
            $obj->save();
        }
    }

    private function saveSemester($user) {
        $semesterForm = Input::get('semester');
        if (empty($semesterForm)) {
            return;
        }
        foreach ($semesterForm as $semester) {
            if (!empty($semester['id'])) {
                $obj = \Semester::find($semester['id']);
            } else {
                if (empty($semester['level_id'])) {
                    continue;
                }
                $obj = new \Semester;
                $obj->user_id = $user->id;
            }

            if ($obj->user_id != $user->id) {
                continue;
            }

            $obj->level_id = $semester['level_id'];
            $obj->year = $semester['year'];
            $obj->semester = $semester['semester'];

            $school = \School::where('name',trim($semester['school_name']))->first();
            if(empty($school)){
                $school = new \School();
                $school->name = trim($semester['school_name']);
                $school->save();
            }
            $obj->school_id = $school->id;

            if (!empty($semester['delete'])) {
                $obj->delete();
                continue;
            }
            $obj->save();
        }
    }
}
