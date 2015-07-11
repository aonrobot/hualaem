@extends('frontend.layout')

@section('title') Calendar @stop

@section('css')
@parent
{{ HTML::style('frontend/css/fullcalendar.min.css') }}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Calendar</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="well">
        <div class="row">
            <div class="col-md-12" id="calendar">

            </div>
        </div>
    </div>
</div>
@stop

@section('js_foot')
@parent
{{ HTML::script('frontend/js/moment.min.js') }}
{{ HTML::script('frontend/js/fullcalendar.min.js') }}
<script>
    (function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            eventSources: [
                {
                    url: "{{ URL::route('ajax.student.calendar_data',[\Enroll::STATUS_APPROVED]) }}"
                },
                {
                    url: "{{ URL::route('ajax.student.calendar_data',[\Enroll::STATUS_PENDING]) }}",
                    color: 'yellow',
                    textColor: 'black'
                }

            ]
        });
    })();
</script>
@stop