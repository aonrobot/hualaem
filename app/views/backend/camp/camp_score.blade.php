@extends('backend.layout')

@section('title') Score for {{ $camp->name}} @stop

@section('css')
@parent

@stop

@section('content')
<form class="form-horizontal" action="{{ URL::route('admin.camp.camp_score',[$camp->id]) }}" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>Score for {{ $camp->name}}</h1>
            </div>
            <div class="col-md-3">
                <form onsubmit="return false">
                    <input class="form-control input-sm" id="txtSearch">
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Test</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($camp->enrolls as $enroll)
                        @foreach($camp->subjects as $subject)
                        @foreach($subject->tests as $test)
                        <tr class="row-score" data-enroll="{{ $enroll->id }}">
                            <td class="col-name">{{$enroll->user->firstname_th}} {{$enroll->user->lastname_th}}</td>
                            <td>{{$subject->name}}</td>
                            <td>{{$test->name}}</td>
                            <td>
                                <input class="form-control input-sm txt-score" type="number" data-to="sc_{{ $enroll->id }}_{{ $subject->id }}"
                                       name="scored[{{ $enroll->id }}][{{ $test->id }}]" 
                                       value="{{ isset($scored[$enroll->id][$test->id]) ? $scored[$enroll->id][$test->id] : '' }}">
                            </td>
                        </tr>
                        @endforeach
                        <tr class="row-score row-sum">
                            <td class="col-name">{{$enroll->user->firstname_th}} {{$enroll->user->lastname_th}}</td>
                            <td>{{$subject->name}}</td>
                            <td><strong>Total</strong></td>
                            <td class="td-total-subject" data-find="sc_{{ $enroll->id }}_{{ $subject->id }}">
                                
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="btn btn-info" value="Save">
            </div>
        </div>
    </div>
</form>
@stop

@section('js_foot')
@parent
<script>
(function(){
    function reCalcSubject(className){
        var totalScore = 0;
        $('input[data-to='+className+']').each(function(){
            if(this.value != ''){
                var tryParse = parseInt(this.value,10);
                if(!isNaN(tryParse)){
                    totalScore += tryParse;
                }
            }
        });
        
        $('.td-total-subject[data-find='+className+']').text(totalScore);
    }
    
    $('.td-total-subject').each(function(){
        reCalcSubject($(this).data('find'));
    });
    
    $('.txt-score').change(function(){
        reCalcSubject($(this).data('to'));
    });
    
    $('#txtSearch').keyup(function(){
       if(this.value != ''){
           var cols = $('.col-name');
           for(var i = 0,l=cols.length;i<l;i++){
               var col = cols[i];
               if($(col).text().indexOf(this.value) === -1){
                   $(col).parent().hide();
               }else{
                   $(col).parent().show();
               }
           }
       }else{
           $('.col-name').parent().show();
       }
    });
})();
</script>
@stop