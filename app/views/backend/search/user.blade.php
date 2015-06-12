@extends('backend.layout')

@section('title') Add/Edit News @stop

@section('css')
    @parent
    {{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div>
            <div class="row">
                <div class="col-md-12">
                    <input class="form-control" name="search" value="{{ Input::get('search') }}"><br>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Filter
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 search-height-full">
                            <ul>
                                @foreach($filters['provinces'] as $province)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="province_id[]" value="{{ $province->id }}" {{ in_array($province->id,Input::get('province_id',[])) ? 'checked' : '' }}>
                                            {{ $province->name  }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 search-height-full">
                            <ul>
                                @foreach($filters['districts'] as $district)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="district_id[]" value="{{ $district->id }}" {{ in_array($district->id,Input::get('district_id',[])) ? 'checked' : '' }}>
                                            {{ $district->name  }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 search-height-full">
                            <ul class="search-height-2row">
                                @foreach($filters['schools'] as $school)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="school_id[]" value="{{ $school->id }}" {{ in_array($school->id,Input::get('school_id',[])) ? 'checked' : '' }}>
                                            {{ $school->name  }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                            <ul>
                                <li>
                                    <label>
                                        <input type="checkbox" name="sex[]" value="male" {{ in_array('male',Input::get('sex',[])) ? 'checked' : '' }}>
                                        ชาย
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" name="sex[]" value="female" {{ in_array('female',Input::get('sex',[])) ? 'checked' : '' }}>
                                        หญิง
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 search-height-full">
                            <ul class="search-height-2row">
                                @foreach($filters['levels'] as $level)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="level_id[]" value="{{ $level->id }}" {{ in_array($level->id,Input::get('level_id',[])) ? 'checked' : '' }}>
                                            {{ $level->name  }}
                                        </label>
                                    </li>

                                    @if(!empty($level->childs))
                                        @foreach($level->childs as $level2)
                                            <li>
                                                <label>
                                                    <input type="checkbox" name="level_id[]" value="{{ $level2->id }}" {{ in_array($level2->id,Input::get('level_id',[])) ? 'checked' : '' }}>
                                                    --{{ $level2->name  }}
                                                </label>
                                            </li>

                                            @if(!empty($level2->childs))
                                                @foreach($level2->childs as $level3)
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="level_id[]" value="{{ $level3->id }}" {{ in_array($level3->id,Input::get('level_id',[])) ? 'checked' : '' }}>
                                                            ----{{ $level3->name  }}
                                                        </label>
                                                    </li>
                                                @endforeach
                                            @endif

                                        @endforeach
                                    @endif

                                @endforeach
                            </ul>
                            <button class="btn btn-primary" style="width:100%;">Search</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <div class="row">
        <div class="col-md-12" id="containner_user">
            @foreach($users as $user)
            <div class="row">
                <div class="col-md-12 well">
                    <a data-toggle="collapse" data-parent="#containner_user" href="#user_{{ $user->id }}" aria-expanded="false" aria-controls="user_{{ $user->id }}">
                        {{  $user->fullname_th }} ( User: {{ $user->id }} )
                    </a>
                    <div class="collapse" id="user_{{ $user->id }}" >
                        <div class="well">
                            <a href="{{ URL::route('admin.user.view',[$user->id]) }}" class="btn btn-info pull-right">EDIT</a>
                            Name: {{ $user->firstname_th }}<br>
                            Surname: {{ $user->lastname_th }}<br>
                            Nickname: {{ $user->nickname }}<br>
                            Phone: {{ $user->mobile }}<br>
                            @if(!empty($user->current_school))
                            School: {{ $user->current_school->name }}<br>
                            @endif
                            Address: {{ $user->addresses[0]->address }}<br>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        {{ $users->links() }}
    </div>



@stop

@section('js_foot')
    @parent
@stop