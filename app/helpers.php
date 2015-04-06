<?php

Form::macro('myInput', function($name, $placeholder, $type = 'text', $value = null, $options = []) {
    $format = '<input class="form-control input-sm" id="%s" name="%s" type="%s" placeholder="%s" value="%s" required="required" %s>';

    $txtOption = '';
    foreach ($options as $key => $val) {
        $txtOption .= sprintf(' %s="%s"', $key, $val);
    }

    if ($value == null) {
        $value = Input::get($name);
    }
    if ($value == null) {
        $value = Input::old($name);
    }

    return sprintf($format, $name, $name, $type, $placeholder, $value, $txtOption);
});

Form::macro('bsSelectLevel', function($levels, $label, $name, $value = null, $prefix = ''){

    $format = <<<HTML
    <div class="form-group">
        <label for=":name" class="col-sm-2 control-label">:label</label>
        <div class="col-sm-10">
            <select id=":name" name=":name" class="form-control">
                :options
            </select>
        </div>
    </div>
HTML;

    if ($value == null) {
        $value = Input::get($name);
    }
    if ($value == null) {
        $value = Input::old($name);
    }

    if($prefix != ''){
        $levels = $levels->childs;
        $html = '';
        foreach($levels as $level){
            if($level->id != $value){
                $html.='<option value="'.$level->id.'">'.$prefix.' '.$level->name.'</option>';
            }else {
                $html .= '<option value="' . $level->id . '" selected="selected">' . $prefix . ' ' . $level->name . '</option>';
            }

            if(!empty($level->childs)){
                $html .= Form::bsSelectLevel($level, $label, $name, $value, $prefix.'--');
            }
        }
        return $html;
    }else{
        $html = '';
        foreach($levels as $level){
            if($level->id != $value){
                $html .= '<option value="'.$level->id.'">'.$level->name.'</option>';
            }else {
                $html .= '<option value="' . $level->id . '" selected="selected">' . $level->name . '</option>';
            }

            if(!empty($level->childs)){
                $html .= Form::bsSelectLevel($level, $label, $name, $value, $prefix.'--');
            }
        }

        $map = [
            ':label' => $label,
            ':name' => $name,
            ':value' => $value,
            ':options' => $html,
        ];

        return str_replace(array_keys($map), array_values($map), $format);
    }
});

Form::macro('bsInlineGroup', function($label, $name, $value = null, $placeholder = null, $type = 'text', $options = []) {
    $format = <<<HTML
    <div class="form-group">
        <label for=":name" class="col-sm-2 control-label">:label</label>
        <div class="col-sm-10">
            <input type=":type" class="form-control" id=":name" name=":name" placeholder=":placeholder" value=":value" :options>
        </div>
    </div>       
HTML;

    $txtOption = '';
    foreach ($options as $key => $val) {
        $txtOption .= sprintf(' %s="%s"', $key, $val);
    }

    if ($placeholder == null) {
        $placeholder = $label;
    }

    if ($value == null) {
        $value = Input::get($name);
    }
    if ($value == null) {
        $value = Input::old($name);
    }

    $map = [
        ':label' => $label,
        ':name' => $name,
        ':placeholder' => $placeholder,
        ':type' => $type,
        ':value' => $value,
        ':options' => $txtOption,
    ];

    return str_replace(array_keys($map), array_values($map), $format);
});
