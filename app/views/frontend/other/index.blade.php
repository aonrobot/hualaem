@extends('frontend.layout')

@section('title') Register @stop

@section('content')

<div class="container">
    <div class="row">
        <section class="col-md-8">
            <h1>Latest News</h1>
            @forelse($newses as $news)
            <article class="well">
                <div class="row">
                    <div class="col-md-12">
                        <header>
                            <a href="{{ route('guest.news.view',[$news->id]) }}">
                                <h2 style="margin:0;">{{ $news->name }}</h2>
                            </a>
                            <small>Publish By {{ $news->user->fullname_th }} at {{ $news->publish_at }}</small>
                        </header>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr style="margin:0">
                        {{ $news->getExcerpt() }}
                    </div>
                </div>
            </article>
            @empty
            <strong>No News</strong>
            @endforelse
        </section>
        <section class="col-md-4">
            <h1>Open Camp</h1>
            <div class="well">
                @foreach($camps as $camp)
                <div class="row">
                    <div class="col-md-12">
                        <article class="well">
                            <div class="media">
                                <div class="media-left">
                                    <a href="{{ URL::route('guest.camp.view',[$camp->id]) }}">
                                        <img class="media-object" src="{{ $camp->image_path }}" alt="{{ $camp->name }}" width="128" height="128">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <a href="{{ URL::route('guest.camp.view',[$camp->id]) }}">
                                        <h4 class="media-heading">{{ $camp->name }}</h4>
                                    </a>
                                    {{ $camp->place }}<br>
                                    {{ $camp->camp_start }} - {{ $camp->camp_end }}

                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

@stop

@section('js_foot')
@parent
@stop