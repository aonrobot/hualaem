<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class SearchController extends BackendController {

    private function _getFilteredData(){
        $data = [];

        $users = \User::orderBy('created_at','desc')->paginate();

        $provinces = \Province::orderBy('name')->get();
        $districts = \District::orderBy('name')->get();
        $schools = \School::orderBy('name')->get();
        $levels = \Level::where('parent_id',null)->with('childs','childs.childs')->orderBy('order')->get();
        $filters = compact('provinces','districts','schools','levels');

        $data['users'] = $users;
        $data['filters'] = $filters;

        return $data;
    }

    public function getUser(){
        return $this->view('search.user',$this->_getFilteredData());
    }

}
