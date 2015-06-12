@extends('backend.layout')

@section('title') Score for {{ $enroll->user->fullname_th }} in {{ $camp->name}} @stop

@section('css')
@parent

@stop

@section('content')
<form class="form-horizontal" action="{{ URL::route('admin.camp.score',[$enroll->id]) }}" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12">
            <h1>Score for {{ $enroll->user->fullname_th }} in {{ $camp->name}}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="subject_list" class="panel-group" role="tablist" aria-multiselectable="true">

                @foreach($camp->subjects as $subjectIndex => $subject)
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="subject{{ $subjectIndex }}">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#subject_list" href="#collapseSubject{{ $subjectIndex }}" aria-expanded="true" aria-controls="collapseSubject{{ $subjectIndex }}">
                                {{ $subjectIndex + 1}} Subject : {{ $subject->name }}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseSubject{{ $subjectIndex }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="subject{{ $subjectIndex }}">
                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach($subject->tests as $testIndex => $test)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-9">
                                            {{ $test->name }}
                                        </div>
                                        <div class="col-md-3">
                                            <input name="scores[{{ $test->id}}]" class="form-control input-sm"
                                                   value="{{ isset($scored[$test->id]) ? $scored[$test->id]->score : '' }}">
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-info" value="Save">
        </div>
    </div>
</form>
@stop

@section('js_foot')
@parent

@stop