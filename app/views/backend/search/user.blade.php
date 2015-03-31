@extends('backend.layout')

@section('title') Add/Edit News @stop

@section('css')
    @parent
    {{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
@stop

@section('content')
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Search</h1>
                    </div>
                </div>

            </div>

            <div class="container">
                <div class="well">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Filter</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 search-height-full">
                            <ul>
                                @foreach($filters['provinces'] as $province)
                                    <li>{{ $province->name  }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 search-height-full">
                            <ul>
                                @foreach($filters['districts'] as $district)
                                    <li>{{ $district->name  }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 search-height-full">
                            <ul>
                                @foreach($filters['schools'] as $school)
                                    <li>{{ $school->name  }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 search-height-full">
                            <ul>
                                @foreach($filters['levels'] as $level)
                                    <li>{{ $level->level  }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="well" id="containner_user">
                    @foreach($users as $user)
                    <div class="row">
                        <div class="col-md-12 well">
                            <a data-toggle="collapse" data-parent="#containner_user" href="#user_{{ $user->id }}" aria-expanded="false" aria-controls="user_{{ $user->id }}">
                                {{  $user->fullname_th }} ( {{ $user->username }} )
                            </a>
                            <div class="collapse" id="user_{{ $user->id }}" >
                                <div class="well">
                                    Name: {{ $user->firstname_th }}<br>
                                    Surname: {{ $user->lastname_th }}<br>
                                    Nickname: {{ $user->nickname }}<br>
                                    Phone: {{ $user->mobile }}<br>
                                    @if(!empty($user->current_school))
                                    School: {{ $user->current_school->name }}<br>
                                    @endif
                                    Address: {{ $user->addresses()->first()->address }}<br>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>


    </form>
@stop

@section('js_foot')
    @parent
@stop