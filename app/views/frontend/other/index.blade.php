@extends('frontend.layout')

@section('title') Hualaem Foundation @stop

@section('content')

    <div class="container">
        <div class="row">
            <section class="col-md-8">
                <h1>Latest News</h1>
                @forelse($newses as $news)
                    <article>

                        <header>
                            <h2>
                                <a href="{{ route('guest.news.view',[$news->id]) }}">{{ $news->name }}</a>
                            </h2>

                            <p class="lead">
                                by
                                <a href="{{ route('user.profile.view',$news->user->id) }}">{{ $news->user->fullname_th }}</a>
                            </p>

                            <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $news->publish_at }}</p>
                            <hr>
                        </header>

                        {{ $news->getExcerpt() }}

                        <footer>
                            <a class="btn btn-primary" href="{{ route('guest.news.view',[$news->id]) }}">Read More <span
                                        class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>
                        </footer>
                    </article>
                @empty
                    <strong>No News</strong>
                @endforelse
            </section>
            <section class="col-md-4 well">
                <h4>Open Camp</h4>


                @forelse($camps as $camp)
                    <div class="media">
                        <div class="media-left media-middle">
                            <a href="{{ URL::route('guest.camp.view',[$camp->id]) }}">
                                <img class="media-object thumb-64" src="{{ $camp->image_path }}"
                                     alt="{{ $camp->name }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ URL::route('guest.camp.view',[$camp->id]) }}">
                                    {{ $camp->name }}
                                </a>
                            </h4>
                            @if(!empty($camp->level))
                                ระดับชั้น {{ $camp->level->name }}<br>
                            @endif
                            {{ $camp->place }} @if(!empty($camp->province)) ({{ $camp->province->name }}) @endif <br>
                            {{ $camp->camp_start }} - {{ $camp->camp_end }}
                        </div>
                    </div>
                @empty
                    <strong>No Camp</strong>
                @endforelse

            </section>
        </div>
    </div>

@stop
