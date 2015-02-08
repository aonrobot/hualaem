@foreach($fields as $field)

<div class="row">
    <div class="col-md-3"><storng>{{$field->campFields->name}}</storng></div>
    <div class="col-md-9">
        
        @if($field->campFields->type === \CampField::TEXT)
        <input type="text" class="form-control" value="{{$field->value }}" readonly>
        @elseif($field->campFields->type === \CampField::TEXTAREA)
        <textarea class="form-control" readonly>{{$field->value }}</textarea>
        @elseif($field->campFields->type === \CampField::FILE)
        <a href="{{ URL::route('admin.camp.download_application_file',[$field->id]) }}">
            Download
        </a>
        @endif
    </div>
</div>

@endforeach