@extends('frontend.layout')

@section('title') List Camp @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Camp List <a href="{{ URL::route('admin.camp.add') }}" class="btn btn-info btn-sm">Add</a></h1>
        </div>
    </div>
</div>

<div class="container well">

    @foreach($camps as $k => $camp)
        @if($k % 2 == 0)
        <div class="row">
        @endif
            <div class="col-md-4 col-md-offset-1 well">
                <article>
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ URL::route('admin.camp.view',[$camp->id]) }}">
                                <img class="media-object" src="{{ $camp->image_path }}" alt="{{ $camp->name }}" width="128" height="128">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="{{ URL::route('admin.camp.view',[$camp->id]) }}">
                                <h3 class="media-heading">{{ $camp->name }}</h3>
                            </a>
                            {{ $camp->place }}<br>
                            <a href="{{ URL::route('admin.camp.edit',[$camp->id]) }}" class="btn btn-warning btn-xs">
                                Edit
                            </a>
                            <a href="{{ URL::route('admin.camp.application',[$camp->id]) }}" class="btn btn-info btn-xs">
                                View Application
                            </a>
                        </div>
                    </div>

                </article>
            </div>
        @if($k % 2 == 1)
        </div>
        @endif
    @endforeach
        @if(isset($k) && $k % 2 == 0)
        </div>
        @endif
</div>
<div class="container">
    <div class="row">
        {{ $camps->links() }}
    </div>
</div>
@stop

@section('js_foot')
@parent

@stop