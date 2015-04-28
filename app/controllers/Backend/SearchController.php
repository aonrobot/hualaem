<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class SearchController extends BackendController {

    private function _getFilteredData(){
        $data = [];

        $query = \User::orderBy('created_at','desc')->with('addresses','addresses.province');

        if(Input::has('province_id')){
            $query->whereHas('addresses.province',function($subQuery){
                $subQuery->whereIn('id',Input::get('province_id'));
            });
        }
        if(Input::has('district_id')){
            $query->whereHas('addresses.district',function($subQuery){
                $subQuery->whereIn('id',Input::get('district_id'));
            });
        }
        if(Input::has('school_id')){
            $query->whereHas('semesters.school',function($subQuery){
                $subQuery->whereIn('id',Input::get('school_id'));
            });
        }
        if(Input::has('level_id')){
            $query->whereHas('semesters.level',function($subQuery){
                $subQuery->whereIn('id',Input::get('level_id'));
            });
        }

        if(Input::has('sex')){
            if(in_array('male',Input::get('sex'))) {
                $query->whereIn('prefix_th',['นาย','เด็กชาย']);
            }
            if(in_array('female',Input::get('sex'))) {
                $query->whereIn('prefix_th',['นางสาว','เด็กหญิง']);
            }
        }

        if(Input::has('search')){
			$query->where(function($searchQuery){
				$searchQuery->where(function($subQuery){
					$searchField = ['username', 'prefix_th', 'firstname_th', 'lastname_th', 'prefix_en', 'firstname_en', 'lastname_en', 'mobile_no', 'email', 'nickname', 'birthdate'];
					foreach($searchField as $field){
						$subQuery->orWhere($field,'like','%'.Input::get('search').'%');
					}
				});

				
				$searchQuery->orWhereHas('addresses',function($subQuery){
					$subQuery->where(function($subSearchQuery){
						$searchField = ['name', 'house_no', 'road', 'village_no', 'village', 'sub_district_id', 'district_id', 'province_id', 'postcode', 'phone_no'];
					
						foreach($searchField as $field){
							$subSearchQuery->orWhere($field,'like','%'.Input::get('search').'%');
						}
					});
					
				});
			});
            
			
        }

        $users = $query->paginate();

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

    public function postUser(){
        return $this->view('search.user',$this->_getFilteredData());
    }

}
