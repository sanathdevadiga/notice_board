@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>

@stop
@section('content')
<h2 style="text-align:center">Welcome to Admin Page</h2><br>

    <form action="{{route('addclass')}}" method="post" >
        @csrf
        <div class="row">
            <select name="dept" id="dept" class="form-control col-md-1">
                <option value="dept" selected disabled>Dept</option>
            </select>
            <select name="sem" id="sem" class="form-control col-md-1 offset-1">
                <option value="sem" selected disabled>Sem</option>
            </select>
            <select name="sec" id="sec" class="form-control col-md-1 offset-1">
                <option value="sec" selected disabled>Sec</option>
            </select>
            <select name="staff" id="staff" class="form-control col-md-1 offset-1">
                <option value="staff" selected disabled>Staff</option>
            </select>
            <select name="subject" id="subject" class="form-control col-md-2 offset-1">
                <option value="subject" selected disabled>Subject</option>
            </select>
            <button class="btn btn-success offset-1">Submit</button>
        </div>
    </form>
    <table class="table table-hover mt-4" id="table">
        <thead>
        <tr>
            <th>SI No.</th>
            <th>Dept</th>
            <th>Sem</th>
            <th>Sec</th>
            <th>Subject</th>
            <th>Lecturer</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <span hidden="hidden">{{$c=0}}</span>
        @foreach($details as $detail)
            <tr>
                <form action="{{route('editclass')}}" method="post">
                    @csrf
                <td hidden="hidden"><input type="text" name="id" value="{{$detail->id}}"></td>
                <td>{{$c+=1}}</td>
                <td>{{$detail->dept}}</td>
                <td>{{$detail->sem}}</td>
                <td>{{$detail->sec}}</td>
                <td>{{$detail->subname}}</td>
                <td>
                    <select name="name" id="" class="form-control">
                       @foreach($staffs as $staff)
                           @if ($staff->name==$detail->name)
                                <option value="{{$staff->name}}" selected>{{$staff->name}}</option>
                           @else
                                <option value="{{$staff->name}}">{{$staff->name}}</option>
                            @endif
                       @endforeach
                    </select>
                </td>
                <td><button type="submit" class="btn btn-primary btn-block">Edit</button></td>
                </form>
            </tr>
        @endforeach
        </tbody>
    </table>
    @push('js')
        <script>
            $(document).ready(
                function()
                {
                    $('#dept').empty().append("<option selected disabled>Dept</option>");
                    $.ajax({
                        'url':'{{route('getalldept')}}',
                        'method':'get',
                        'datatype':'json',
                        'success':function (data) {
                            data=JSON.parse(data);
                            data.forEach(function (item) {
                                $('#dept'). append($('<option>', { value : item.sem }).text(item.dept));
                            });

                        },
                        'error':function (data) {
                            alert(data);
                        }


                    })

                    $('#staff').empty().append("<option selected disabled>Staff</option>");
                    $.ajax({
                        'url':'{{route('getstaff')}}',
                        'method':'get',
                        'datatype':'json',
                        'success':function (data) {
                            data=JSON.parse(data);
                            data.forEach(function (item) {
                                $('#staff'). append($('<option>', { value : item.name }).text(item.name));
                            });

                        },
                        'error':function (data) {
                            alert(data);
                        }


                    })


                    $('#subject').empty().append("<option selected disabled>Subject</option>");
                    $.ajax({
                        'url':'{{route('getsubject')}}',
                        'method':'get',
                        'datatype':'json',
                        'success':function (data) {
                            data=JSON.parse(data);
                            data.forEach(function (item) {
                                $('#subject'). append($('<option>', { value : item.subname }).text(item.subname));
                            });

                        },
                        'error':function (data) {
                            alert(data);
                        }


                    })


                    $('#dept').change(
                        function() {
                            var dept=$('#dept').val();
                            // var sem=$('#sem').val();
                            // var sec=$('#sec').val();
                            $('#sem').empty().append("<option selected disabled>Sem</option>");
                            $('#sec').empty().append("<option selected disabled>Sec</option>");
                            $.ajax({
                                'url':'{{route('getallsem')}}',
                                'method':'get',
                                'datatype':'json',
                                'data':"dept="+dept,
                                'success':function (data) {
                                    data=JSON.parse(data);
                                    data.forEach(function (item) {
                                        $('#sem'). append($('<option>', { value : item.sem }).text( item.sem));
                                    });

                                },
                                'error':function (data) {
                                    alert(data);
                                }


                            })
                        }
                    );
                    $('#sem').change(
                        function() {
                            var dept=$('#dept').val();
                            var sem=$('#sem').val();
                            // var sec=$('#sec').val();
                            $('#sec').empty().append("<option selected disabled>Sec</option>");
                            $.ajax({
                                'url':'{{route('getallsec')}}',
                                'method':'get',
                                'datatype':'json',
                                cache:false,
                                'data':"dept="+dept+"&sem="+sem,
                                'success':function (data) {
                                    data=JSON.parse(data);
                                    data.forEach(function (item) {
                                        $('#sec').append($('<option>', { value : item.sec }).text( item.sec));
                                    });

                                },
                                'error':function (data) {
                                    alert(data);
                                }


                            })
                        }
                    )
                }
            );
        </script>

    @endpush
@stop
