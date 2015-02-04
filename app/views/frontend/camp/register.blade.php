@extends('frontend.layout')

@section('title') Register @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $camp->name }}</h1>
        </div>
    </div>
</div>
<form class="form-horizontal" method="POST" enctype="multipart/form-data">
    <div class="container well">
        <div class="row">
            <div class="col-md-12">
                <h2>Register Information</h2>
                
                @foreach($camp->fields as $field)
                <div class="form-group">
                    <label for="field_{{$field->id}}" class="col-sm-2 control-label">
                        {{ $field->name }}
                        @if($field->is_required)
                        <span style="color:#F00">*</span>
                        @endif
                    </label>
                    <div class="col-sm-10">
                        @if($field->type === \CampField::TEXT)
                        <input type="text" class="form-control" id="field_{{$field->id}}" name="field_{{$field->id}}" value="{{ Input::old("field_{$field->id}") }}">
                        @elseif($field->type === \CampField::TEXTAREA)
                        <textarea class="form-control" id="field_{{$field->id}}" name="field_{{$field->id}}">{{ Input::old("field_{$field->id}") }}</textarea>
                        @elseif($field->type === \CampField::FILE)
                        <input type="file" id="field_{{$field->id}}" name="field_{{$field->id}}">
                        @endif
                    </div>
                </div>
                @endforeach
                
                <button type="submit" class="btn btn-info">Confirm</button>
            </div>
        </div>
    </div>
</form>
@stop

@section('js_foot')
@parent

@stop