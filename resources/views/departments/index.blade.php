@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>

@stop
@section('content')
<h2 style="text-align:center">Welcome to Admin Page</h2><br>

    {!! Form::open(['route' => 'departments.store', 'method' => 'post']) !!}
    <div class="row">
        {!! Form::text('dept', '', ['class' => 'form-control col-md-2 offset-1', 'placeholder'=>'Department', 'required'=>true]) !!}
        {!! Form::text('sem', '', ['class' => 'form-control col-md-2 offset-1', 'placeholder'=>'Sem','required'=>true]) !!}
        {!! Form::text('sec', '', ['class' => 'form-control col-md-2 offset-1', 'placeholder'=>'Sec','required'=>true]) !!}
        {!! Form::submit('Submit', ['class' => 'btn btn-success offset-1']) !!}
    </div>
    {!! Form::close() !!}
    <table class="table table-hover mt-4" id="table">
        <thead>
            <tr>
                <th>SI No.</th>
                <th>Dept</th>
                <th>Sem</th>
                <th>Sec</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <span hidden="hidden">{{$c=0}}</span>
        @foreach($depts as $dept)
            <tr>
                <td>{{$c+=1}}</td>
                <td>{{$dept->dept}}</td>
                <td>{{$dept->sem}}</td>
                <td>{{$dept->sec}}</td>
                <td><button onclick="myf({{$dept->id}})" class="btn btn-primary">Delete</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @push('js')
        <script>
            function myf(id){
                $.ajax(
                    {
                        'url':'{{route('deletedepts')}}',
                        'method':'get',
                        'datatype':'json',
                        'data':'id='+id,
                        'success':function (data) {
                            if (data==1) {
                                alert("deleted successfully");
                            }
                            else{
                                alert("can't delete");
                            }
                            document.location.reload();
                        },
                        'error':function (data) {
                            alert(data);
                        }

                    }
                )
            }
          
        </script>

    @endpush
@stop

