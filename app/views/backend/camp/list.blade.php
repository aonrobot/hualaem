@extends('backend.layout')

@section('title') Camp List @stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Camp List <a href="{{ URL::route('admin.camp.add') }}" class="btn btn-info btn-sm">Add</a></h1>
        </div>
    </div>

    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Place</th>
                <th>Register</th>
                <th>Activity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($camps as $k => $camp)
            <tr>
                <td>{{ $camp->id }}</td>
                <td><a href="{{ URL::route('admin.camp.view',[$camp->id]) }}">{{ $camp->name }}</a></td>
                <td>{{ $camp->place }}</td>
                <td>{{ $camp->register_start }} - {{ $camp->register_end }}</td>
                <td>{{ $camp->camp_start }} - {{ $camp->camp_end }}</td>
                <td>
                    <a href="{{ URL::route('admin.camp.edit',[$camp->id]) }}" class="btn btn-warning btn-xs">
                        Edit
                    </a>
                    <a href="{{ URL::route('admin.camp.application',[$camp->id]) }}" class="btn btn-info btn-xs">
                        View Application
                    </a>
                    @if(!$camp->is_judge)
                        <button class="btn btn-success btn-xs btn-judged" data-id="{{ $camp->id }}">
                            ประกาศผล
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row">
        {{ $camps->links() }}
    </div>

@stop

@section('js_foot')
@parent
<script>
    $(document).ready(function(){
        $('.btn-judged').click(function(){
            var obj = $(this);
            var id = obj.data('id');
            $.post('{{ route('admin.camp.judged') }}/'+id,function(data){
                if(data.status == 'success'){
                    obj.remove();
                    alert("ส่งอีเมล์รายงานผลเรียบร้อยแล้ว");
                }else{
                    alert(data.message);
                }
            });
        });
    });
</script>
@stop