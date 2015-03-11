<?php

class BaseController extends Controller {

    public $view_prefix = '';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function view($name, $data = []) {
        if(Session::has('infos')){
            $data['infos'] = Session::get('infos');
        }

        return View::make($this->view_prefix . $name, $data);
    }

}
