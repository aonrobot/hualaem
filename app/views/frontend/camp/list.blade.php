@extends('frontend.layout')

@section('title') Active Camp List @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Active Camp List</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="well">
        @foreach($camps as $k => $camp)
            @if($k % 2 == 0)
            <div class="row">
            @endif
                <div class="col-md-6">
                    <article class="well">
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
            @if($k % 2 == 1)
            </div>
            @endif
        @endforeach
            @if(isset($k) && $k % 2 == 0)
            </div>
            @endif
    </div>
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