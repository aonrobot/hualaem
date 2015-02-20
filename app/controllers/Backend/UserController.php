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
        $user = \User::findOrFail($userID);
        $user->load('addresses', 'parents');

        $registerCamps = $user->enrolls()->with('camp')->whereHas('camp', function($q) {
                    $q->where('camp_end', '>=', date('Y-m-d'));
                })->get();

        $historyCamps = $user->enrolls()->with('camp')->whereHas('camp', function($q) {
                    $q->where('camp_end', '<', date('Y-m-d'));
                })->take(10)->orderBy('id')->get();
                
        $userLogs = $user->logs()->orderBy('id','desc')->limit(20)->get();

        return $this->view('user.view', compact('user', 'registerCamps', 'historyCamps','userLogs'));
    }

    public function getEdit($userID) {
        $user = \User::findOrFail($userID);
        $user->load('addresses', 'parents');

        $allProvinces = \Province::orderBy('name')->get();
        $provinces = [];
        foreach ($allProvinces as $province) {
            $provinces[$province->id] = $province->name;
        }
        $allDistricts = \District::orderBy('name')->get();
        $districts = [];
        foreach ($allDistricts as $district) {
            $districts[] = [
                'id'=>$district->id,
                'name'=> $district->name,
                'parent_id'=> $district->province_id,
            ];

        }

        $allSubDistricts = \SubDistrict::orderBy('name')->get();
        $subDistricts = [];
        foreach ($allSubDistricts as $subDistrict) {
            $subDistricts[] = [
                'id'=>$subDistrict->id,
                'name'=> $subDistrict->name,
                'parent_id'=> $subDistrict->district_id,
            ];
        }

        return $this->view('user.edit', compact('user', 'provinces', 'districts', 'subDistricts'));
    }

    public function postEdit($userID) {
        $user = \User::findOrFail($userID);
        //TODO: validate input

        $userForm = Input::get('user');
        $insUserForm = array_only($userForm, ['firstname_th', 'lastname_th', 'nickname', 'birthdate', 'mobile_no', 'email', 'citizen_id']);
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

        $addressForm = Input::get('address');
        $insAddressField = ['name', 'house_no', 'road', 'village_no', 'village', 'sub_district_id', 'district_id', 'province_id', 'postcode', 'phone_no'];
        foreach ($addressForm as $address) {
            if (!empty($address['id'])) {
                $obj = \Address::find($address['id']);
            } else {
                if(empty($address['name'])){
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
        return "AAA;";
        //return \Redirect::route('admin.user.view', [$user->id]);
    }

}
