<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Input;

class UserController extends FrontendController {

    public function getCalendar() {
        return $this->view('user.calendar');
    }

    public function getCalendarData($status) {
        $user = \Auth::user();
        if($status == 'PENDING'){
            $status = [\Enroll::STATUS_PENDING,\Enroll::STATUS_DOCUMENT_RECIEVED];
        }else{
            $status = [$status];
        }
        $enrolls = $user->enrolls()->whereIn('status', $status)->whereHas('camp', function($q) {
                    $start = Input::get('start');
                    $end = Input::get('end');
                    $q->where(function($q) use ($start, $end) {
                        $q->where('camp_start', '>=', $start)->where('camp_start', '<=', $end);
                    });

                    $q->orWhere(function($q) use ($start, $end) {
                        $q->where('camp_end', '>=', $start)->where('camp_end', '<=', $end);
                    });
                })->with('camp')->get();

        $events = [];
        foreach ($enrolls as $enroll) {
            $events[] = [
                'title' => $enroll->camp->name,
                'start' => $enroll->camp->camp_start,
                'end' => $enroll->camp->camp_end,
                'url' => \URL::route('guest.camp.view', $enroll->camp->id),
            ];
        }

        return \Response::json($events);
    }

    public function getLogout() {
        \Auth::logout();
        return \Redirect::to('/');
    }

    public function getProfile($userID = 0) {
        // Duplicate with Backend/UserController/getView

        if (empty($userID)) {
            $userID = \Auth::user()->id;
        }

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

    public function getEdit() {
        $user = \Auth::user();
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

        return $this->view('user.edit', compact('user', 'provinces', 'districts', 'subDistricts'));
    }

    public function postEdit() {
        $user = \Auth::user();
        //TODO: validate input

        $this->saveUser($user);
        $this->saveAddress($user);
        $this->saveParent($user);

        return \Redirect::route('user.profile.view', [$user->id]);
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

}
