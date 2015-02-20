@extends('frontend.layout')

@section('title') Calendar @stop

@section('css')
@parent
{{ HTML::style('css/fullcalendar.min.css') }}
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
{{ HTML::script('js/moment.min.js') }}
{{ HTML::script('js/fullcalendar.min.js') }}
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