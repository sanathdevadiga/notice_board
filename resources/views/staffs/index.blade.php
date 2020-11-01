@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>

@stop
@section('content')
<h2 style="text-align:center">Welcome to Admin Page</h2><br>


    {!! Form::open(['route' => 'staffs.store', 'method' => 'post']) !!}
    <div class="row">
        {!! Form::text('name', '', ['class' => 'form-control col-md-2 ', 'placeholder'=>'Name', 'required'=>true]) !!}
        {!! Form::text('ssn', '', ['class' => 'form-control col-md-2 offset-1', 'placeholder'=>'SSN','required'=>true]) !!}
        {!! Form::select('role', $roles->pluck('permission','permission') , null , ['class' => 'form-control col-md-1 offset-1']) !!}
        {!! Form::password('pwd', ['class' => 'form-control col-md-2 offset-1', 'placeholder'=>'Password','required'=>true]) !!}
        {!! Form::submit('Submit', ['class' => 'btn btn-success offset-1']) !!}
    </div>
    {!! Form::close() !!}
    <table class="table table-hover mt-4" id="table">
        <thead>
        <tr>
            <th>SI No.</th>
            <th>Name</th>
            <th>SSN</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <span hidden="hidden">{{$c=0}}</span>
        @foreach($staffs as $staff)
            <tr>
                <td>{{$c+=1}}</td>
                <td>{{$staff->name}}</td>
                <td>{{$staff->ssn}}</td>
                <td><button onclick="myf({{$staff->id}})" class="btn btn-primary">Delete</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @push('js')
        <script>
            function myf(id){
                $.ajax(
                    {
                        'url':'{{route('deletestaff')}}',
                        'method':'get',
                        'datatype':'json',
                        'data':'id='+id,
                        'success':function (data) {
                            if (data==1) {
                                alert("deleted successfully");
                            }
                            else if (data==-1){
                                alert("can't delete yourself");
                            }
                            else if (data==-3){
                                alert("can't delete as the lecturer is serving some class");
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

