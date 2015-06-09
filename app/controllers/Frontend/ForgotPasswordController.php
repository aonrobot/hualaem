<?php

namespace mix5003\Hualaem\Frontend;

use FrontendController;

class ForgotPasswordController extends FrontendController {

    public function getIndex() {
        return $this->view('user.forgot_password_form');
    }

    public function postIndex(){
        $user = \User::where('email',\Input::get('email'))->first();
        if(!$user){
            return \Redirect::back()->withErrors(['User not found']);
        }

        $token = base64_encode(str_random());
        $user->recovery_token = $token;
        $user->save();
        $data = ['user'=>$user->toArray()];
        \Mail::queue('email.forgot_password',$data,function(\Illuminate\Mail\Message  $message) use ($data){
            $message->to($data['user']['email']);
            $message->subject('Recovery Password From Hualaem');
        });

        return \Redirect::back()->with('infos',['Send Recovery mail']);
    }

    public function getSetPassword($id, $token){
        $user = \User::find($id);
        if(!$user){
            return \Redirect::back()->withErrors(['User not found']);
        }
        if(empty($user->recovery_token) || empty($token) || $user->recovery_token != $token){
            return \Redirect::back()->withErrors(['Token mismatch']);
        }

        return $this->view('user.forgot_password_reset',[
            'reset_user'=>$user,
        ]);
    }

    public function postSetPassword(){
        $id = \Input::get('id');
        $token = \Input::get('token');
        $user = \User::find($id);
        if(!$user){
            return \Redirect::back()->withErrors(['User not found']);
        }
        if(empty($user->recovery_token) || empty($token) || $user->recovery_token != $token){
            return \Redirect::back()->withErrors(['Token mismatch']);
        }

        $v = \Validator::make(\Input::all(),[
            'password' => 'required|confirmed|min:6'
        ]);

        if($v->passes()){
            $user->password = \Hash::make(\Input::get('password'));
            $user->recovery_token = null;
            $user->save();

            return \Redirect::to('/')->with('infos',['Reset password succesfully']);
        }else{
            return \Redirect::back()->withInput()->withErrors($v);
        }
    }

}