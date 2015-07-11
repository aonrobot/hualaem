<div class="{{ $class }} text-center">
    <a href="{{ URL::route('guest.camp.view',[$camp->id]) }}">
        <img src="{{ $camp->image_path }}"  alt="{{ $camp->name }}" class="img-circle img-responsive center-block camp-img">

        <h3>{{ $camp->name }}</h3>
    </a>
    <p>
        @if(!empty($camp->level))
            ระดับชั้น {{ $camp->level->name }}<br>
        @endif
        {{ $camp->place }} @if(!empty($camp->province)) (จังหวัด{{ $camp->province->name }}) @endif <br>
        {{ $camp->camp_start }} - {{ $camp->camp_end }}
    </p>
</div>