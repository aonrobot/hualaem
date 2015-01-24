<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class CampController extends BackendController {
    public function getAdd(){
        $allProvinces = \Province::orderBy('name')->get();
        $provinces = [];
        foreach ($allProvinces as $province) {
            $provinces[$province->id] = $province->name;
        }

        return $this->view('camp.add',compact('provinces'));
    }
}