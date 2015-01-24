<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class UploadController extends BackendController {

    public function postFile() {
        \Debugbar::disable();
        $funcNumber = Input::get('CKEditorFuncNum');
        if (Input::hasFile('upload')) {
            $rules = [
                'upload' => 'required'
            ];
            $validator = \Validator::make(Input::only('upload'), $rules);
            if ($validator->passes()) {
                $file = Input::file('upload');
                $originalName = $file->getClientOriginalName();

                if (file_exists(public_path('uploads/images/' . $originalName))) {
                    $ext = $file->getClientOriginalExtension();
                    $filename = basename($originalName, '.' . $ext);
                    $filename .='_' . time() . '.' . $ext;
                } else {
                    $filename = $originalName;
                }

                $file->move(public_path('uploads/images/'), $filename);
                $url = \URL::asset('uploads/images/' . $filename);

                return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $funcNumber . ', "' . $url . '", "");</script>';
            } else {
                return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $funcNumber . ', "", "' . $validator->errors()->first() . '");</script>';
            }
        } else {
            return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $funcNumber . ', "", "No Input File");</script>';
        }
    }

    public function postImage() {
        \Debugbar::disable();
        $funcNumber = Input::get('CKEditorFuncNum');
        if (Input::hasFile('upload')) {
            $rules = [
                'upload' => 'required|image'
            ];
            $validator = \Validator::make(Input::only('upload'), $rules);
            if ($validator->passes()) {
                $file = Input::file('upload');
                $originalName = $file->getClientOriginalName();

                if (file_exists(public_path('uploads/images/' . $originalName))) {
                    $ext = $file->getClientOriginalExtension();
                    $filename = basename($originalName, '.' . $ext);
                    $filename .='_' . time() . '.' . $ext;
                } else {
                    $filename = $originalName;
                }

                $file->move(public_path('uploads/images/'), $filename);
                $url = \URL::asset('uploads/images/' . $filename);

                return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $funcNumber . ', "' . $url . '", "");</script>';
            } else {
                return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $funcNumber . ', "", "' . $validator->errors()->first() . '");</script>';
            }
        } else {
            return '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $funcNumber . ', "", "No Input File");</script>';
        }
    }

}
