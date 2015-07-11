@extends('frontend.layout')

@section('title') {{ $news->name }} @stop

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <article>
                <header>
                    <h2>
                        <a href="{{ route('guest.news.view',[$news->id]) }}">{{ $news->name }}</a>
                    </h2>

                    <p class="lead">
                        by
                        <a href="{{ route('user.profile.view',$news->user->id) }}">{{ $news->user->fullname_th }}</a>
                    </p>
                    <hr>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $news->publish_at }}</p>
                </header>
                <hr>
                {{ $news->detail }}
            </article>
        </div>
        <div class="col-md-3">
            <aside class="well">
                <h4>Latest News</h4>
                <ol class="no-bullet">
                    @foreach($lastestNews as $otherNews)
                    <li>
                        <a href="{{ route('guest.news.view',[$otherNews->id]) }}">
                            {{ $otherNews->name }} 
                        </a>
                        <small>({{ $otherNews->short_publish_at }})</small>
                    </li>
                    @endforeach
                </ol>
            </aside>
        </div>
    </div>
</div>

@stop