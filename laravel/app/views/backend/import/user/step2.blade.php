@extends('backend.layout')

@section('title') Register @stop

@section('content')
<div class="section grey" data-anchor="slide1">
    <div class="container">
        <h1 class="page_name">Import</h1>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="step_bar"></div>
    </div>

    <div class="container content">
        <div class="content div block">
            <h1 class="menu_name">Select Field</h1>
            <div class="content camp_detail">
                <div class=" form register_camp">
                    <form class="" action="{{ URL::action('mix5003\Hualaem\Backend\ImportUserController@getStep2') }}" method="POST">
                        @foreach($importable as $keyType => $types)
                        <div>
                            @foreach($types as $type => $fields)
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>{{ $type }}</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach($fields as $field => $label)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>{{ $label }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control input-sm" name="{{$type}}[{{$field}}]">
                                                <option value="">-- None --</option>
                                                @foreach($cols[$keyType] as  $index =>  $csvField)
                                                <option value="{{ $index }}">{{ $index + 1 }}. {{$csvField}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                        <div class="w-clearfix content register">
                            <input class="btn btn-info" value="Next Step"  type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop