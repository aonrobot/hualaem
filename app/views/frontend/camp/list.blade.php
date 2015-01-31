@extends('frontend.layout')

@section('title') Active Camp @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Active List</h1>
        </div>
    </div>
</div>
<form class="form-horizontal" method="POST" enctype="multipart/form-data">
    <div class="container well">
        <div class="row">
            @foreach($camps as $camp)
            <div class="col-md-4 col-md-offset-1 well">
                <article>
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ URL::route('guest.camp.view',[$camp->id]) }}">
                                <img class="media-object" src="{{ $camp->image_path }}" alt="{{ $camp->name }}" width="128" height="128">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="{{ URL::route('guest.camp.view',[$camp->id]) }}">
                                <h3 class="media-heading">{{ $camp->name }}</h3>
                            </a>
                            {{ $camp->place }}<br>
                            {{ $camp->camp_start }} - {{ $camp->camp_end }}
                            
                        </div>
                    </div>

                </article>
            </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row">
            {{ $camps->links() }}
        </div>
    </div>
</form>
@stop

@section('js_foot')
@parent

@stop