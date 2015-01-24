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

Form::macro('bsInlineGroup', function($label, $name, $placeholder=null, $type = 'text', $value = null, $options = []) {
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

    if($placeholder == null){
        $placeholder = $label;
    }
    
    if ($value == null) {
        $value = Input::get($name);
    }
    if ($value == null) {
        $value = Input::old($name);
    }

    $map = [
        ':label'=>$label,
        ':name'=>$name,
        ':placeholder'=>$placeholder,
        ':type'=>$type,
        ':value'=>$value,
        ':options'=>$txtOption,
    ];
    
    return str_replace(array_keys($map), array_values($map), $format);
});
