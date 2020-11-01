@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>
@stop
@section('content')
<h2 style="text-align:center">Welcome to Admin Page</h2><br>

    {!! Form::open(['route' => 'subjects.store', 'method' => 'post']) !!}
    <div class="row">
        {!! Form::text('subname', '', ['class' => 'form-control col-md-2 offset-2', 'placeholder'=>'Name', 'required'=>true]) !!}
        {!! Form::text('subcode', '', ['class' => 'form-control col-md-2 offset-1', 'placeholder'=>'Code','required'=>true]) !!}
        {!! Form::submit('Submit', ['class' => 'btn btn-success offset-1']) !!}
    </div>
    {!! Form::close() !!}
    <table class="table table-hover mt-4 text-center" id="table">
        <thead>
            <tr>
                <th>SI No.</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <span hidden="hidden">{{$c=0}}</span>
        @foreach($subjects as $subject)
            <tr>
                <td>{{$c+=1}}</td>
                <td>{{$subject->subname}}</td>
                <td>{{$subject->subcode}}</td>
                <td><button onclick="myf({{$subject->id}})" class="btn btn-primary">Delete</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>


    @push('js')

        <script>
                function myf(id){
                $.ajax(
                    {
                        'url':'{{route('deletesubject')}}',
                        'method':'get',
                        // 'datatype':'json',
                        'data':'id='+id,
                        'success':function (data) {
                            if (data==1) {
                                alert("deleted successfully");
                            }
                            else if (data==-1){
                                alert("can't delete subject as it is used by some department");
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