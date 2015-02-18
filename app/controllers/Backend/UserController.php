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

        return $this->view('user.view', compact('user', 'registerCamps', 'historyCamps'));
    }

    public function getEdit($userID) {
        $user = \User::findOrFail($userID);
        $user->load('addresses', 'parents');

        return $this->view('user.edit', compact('user'));
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
                $log->user_id = $user->id;
                $log->field = $key;
                $log->old_value = $user->$key;
                $log->new_value = $val;
                $log->save();
                
                $user->$key = $val;
            }
        }
        $user->save();



        return \Redirect::route('admin.user.view', [$user->id]);
    }

}
