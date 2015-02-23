<?php

namespace mix5003\Hualaem\Backend;

use BackendController;
use Input;

class NewsController extends BackendController {

    public function getIndex() {
        $query = \News::with('user')->orderBy('publish_at', 'desc');
        if (Input::has('txtSearchTitle')) {
            $query->where('name', 'like', '%' . Input::get('txtSearchTitle') . '%');
        }
        $news = $query->paginate(20);

        return $this->view('news.list', compact('news'));
    }

    public function getAdd() {
        $news = new \News;
        return $this->view('news.form', compact('news'));
    }

    public function getEdit($newsID) {
        $news = \News::find($newsID);
        return $this->view('news.form', compact('news'));
    }

    public function postSave($newsID = 0) {
        $rules = [
            'name' => 'required',
            'excerpt' => '',
            'detail' => 'required',
            'publish_at' => 'date',
        ];
        $keys = array_keys($rules);

        if (empty($newsID)) {
            $news = new \News;
            $news->user_id = \Auth::user()->id;
        } else {
            $news = \News::find($newsID);
        }

        $inp = Input::only($keys);
        $v = \Validator::make($inp, $rules);

        if ($v->passes()) {
            foreach ($keys as $key) {
                $news->$key = $inp[$key];
            }
            $news->save();

            return \Redirect::route('admin.news.list');
        } else {
            return \Redirect::back()->withErrors($v)->withInput();
        }
    }

}
