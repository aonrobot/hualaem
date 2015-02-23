@extends('frontend.layout')

@section('title') Register @stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <article class="well">
                <div class="row">
                    <div class="col-md-12">
                        <header>
                            <h1 style="margin:0;">{{ $news->name }}</h1>
                            <small>Publish By {{ $news->user->fullname_th }} at {{ $news->publish_at }}</small>
                        </header>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr style="margin:0">
                        {{ $news->detail     }}
                    </div>
                </div>
            </article>
        </div>
        <div class="col-md-3">
            <div class="well">

            </div>
        </div>
    </div>
</div>

@stop

@section('js_foot')
@parent
@stop