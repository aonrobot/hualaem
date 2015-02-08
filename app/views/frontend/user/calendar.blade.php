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
<div class="container well">
    <div class="row">
        <div class="col-md-12" id="calendar">

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
            defaultDate: '2014-11-12',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {
                    title: 'All Day Event',
                    start: '2014-11-01'
                },
                {
                    title: 'Long Event',
                    start: '2014-11-07',
                    end: '2014-11-10'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2014-11-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2014-11-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2014-11-11',
                    end: '2014-11-13'
                },
                {
                    title: 'Meeting',
                    start: '2014-11-12T10:30:00',
                    end: '2014-11-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2014-11-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2014-11-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2014-11-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2014-11-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2014-11-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2014-11-28'
                }
            ]
        });
    })();
</script>
@stop