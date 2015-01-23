<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;
use Input;

class RegisterController extends FrontendController {

    public function getIndex() {
        $allProvinces = \Province::orderBy('name')->get();
        $provinces = [];
        foreach ($allProvinces as $province) {
            $provinces[$province->id] = $province->name;
        }
        $allDistricts = \District::orderBy('name')->get();
        $districts = [];
        foreach ($allDistricts as $district) {
            $districts[$district->id] = $district->name;
        }

        $allSubDistricts = \SubDistrict::orderBy('name')->get();
        $subDistricts = [];
        foreach ($allSubDistricts as $subDistrict) {
            $subDistricts[$subDistrict->id] = $subDistrict->name;
        }

        return $this->view('register', compact('provinces', 'districts', 'subDistricts'));
    }

    public function postIndex() {
        $rules = [
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'email' => 'required|email|unique:users',
            'firstname_th' => 'required',
            'lastname_th' => 'required',
            'nickname' => 'required',
            'mobile_no' => 'required', //TODO: Check Format
            'capcha' => 'required|captcha',
            'house_no' => 'required',
            'road' => 'required',
            'village_no' => 'required|integer|min:1',
            'sub_district_id' => 'required|exists:sub_districts,id', //TODO: Check Exists
            'district_id' => 'required|exists:districts,id', //TODO: Check Exists
            'province_id' => 'required|exists:provinces,id', //TODO: Check Exists
            'postcode' => 'required|integer|min:10000|max:99999',
            'phone_no' => 'required', //TODO: Check Format
        ];

        $inp = Input::only(array_merge(array_keys($rules), array('password_confirmation')));
        $v = \Validator::make($inp, $rules);

        if ($v->passes()) {
            $user = new \User();
            $user->username = Input::get('username');
            $user->password = \Hash::make(Input::get('password'));
            $user->email = Input::get('email');
            $user->firstname_th = Input::get('firstname_th');
            $user->lastname_th = Input::get('lastname_th');
            $user->nickname = Input::get('nickname');
            $user->mobile_no = Input::get('mobile_no');
            $user->save();

            $address = new \Address();
            $address->house_no = Input::get('house_no');
            $address->road = Input::get('road');
            $address->village_no = Input::get('village_no');
            $address->sub_district_id = Input::get('sub_district_id');
            $address->district_id = Input::get('district_id');
            $address->province_id = Input::get('province_id');
            $address->postcode = Input::get('postcode');
            $address->phone_no = Input::get('phone_no');
            $user->addresses()->save($address);
            
            return \Redirect::to('/');
        } else {
            return \Redirect::back()->withErrors($v)->withInput();
        }
    }

}
