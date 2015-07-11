@extends('frontend.layout')

@section('title') Camp List @stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Camp List</h1>

            @foreach($camps as $k => $camp)
                @if($k % 3 == 0)
                <div class="row">
                @endif
                    @include('frontend.partials.camp_circle',['class'=>'col-md-4','camp'=>$camp])
                @if($k % 3 == 2)
                </div>
                @endif
            @endforeach

            @if(isset($k) && $k % 3 != 0)
            </div>
            @endif

            <div class="text-center">
                {{ $camps->links() }}
            </div>
        </div>
    </div>
</div>
@stop