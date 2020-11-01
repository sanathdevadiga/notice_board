@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>
@stop
@section('content')
<h2 style="text-align:center">Welcome to Office Page</h2><br>

    <a href="{{route('students.create')}}" class="btn btn-success">Create</a>

    <form action="">
        <div class="row">
            <select name="dept" id="dept" class="form-control col-md-2 offset-2">
                <option value="dept" selected disabled>Dept</option>
            </select>
            <select name="sem" id="sem" class="form-control col-md-2 offset-1">
                <option value="sem" selected disabled>Sem</option>
            </select>
            <select name="sec" id="sec" class="form-control col-md-2 offset-1">
                <option value="sec" selected disabled>Sec</option>
            </select>
        </div>
    </form>
    <table class="table table-hover mt-4 text-center" id="table">
        <thead>
            <tr>
                <th>SI No.</th>
                <th>USN</th>
                <th>Name</th>
                <th>Ph no.</th>
                <th>Department</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@push('js')
    <script>
            $(document).ready(
                function()
                {

                    $.ajax({
                        'url':'{{route('getid')}}',
                        'method':'get',
                        'datatype':'json',
                        'success':function (data) {
                            alert(data);

                        },
                        'error':function (data) {
                            alert(data);
                        }


                    })


                    $('#dept').empty().append("<option selected disabled>Dept</option>");
                    $.ajax({
                        'url':'{{route('getalldept')}}',
                        'method':'get',
                        'datatype':'json',
                        'success':function (data) {
                            data=JSON.parse(data);
                            data.forEach(function (item) {
                                $('#dept'). append($('<option>', { value : item.dept }).text(item.dept));
                            });

                        },
                        'error':function (data) {
                            alert(data);
                        }
                    })
                    $.ajax({
                        'url':'{{route('studentdetails')}}',
                        'method':'get',
                        'datatype':'json',
                        'success':function (data) {
                            var c=1;
                            // alert(data);
                            data=JSON.parse(data);
                            $('#table tbody').empty();
                            data.forEach(function (item) {
                                var route="{{route('students.edit','id')}}";
                                route = route.replace('id', item.id);
                                // alert(item.id);
                                $('#table tbody').append('<tr>'+
                                    '<td>'+c+++'</td>'+
                                    '<td>'+item.usn+'</td>'+
                                    '<td>'+item.name+'</td>'+
                                    '<td>'+item.phone+'</td>'+
                                    '<td>'+item.dept+'</td>'+
                                    '<td><a class="btn btn-primary btn-block" href="'+route+'">Edit</a></td>'+
                                    '</tr>');
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
                            $.ajax({
                            'url':'{{route('studentdetails')}}',
                            'method':'get',
                            'data':"dept="+dept,
                            'datatype':'json',
                            'success':function (data) {
                                var c=1;
                                // alert(data);
                                data=JSON.parse(data);
                                $('#table tbody').empty();
                                data.forEach(function (item) {
                                    var route="{{route('students.edit','id')}}";
                                    route = route.replace('id', item.id);
                                    // alert(item.id);
                                    $('#table tbody').append('<tr>'+
                                        '<td>'+c+++'</td>'+
                                        '<td>'+item.usn+'</td>'+
                                        '<td>'+item.name+'</td>'+
                                        '<td>'+item.phone+'</td>'+
                                        '<td>'+item.dept+'</td>'+
                                        '<td><a class="btn btn-primary btn-block" href="'+route+'">Edit</a></td>'+
                                        '</tr>');
                            });

                            },
                            'error':function (data) {
                                alert(data);
                            }
                        })

                    });
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
                            $.ajax({
                                'url':'{{route('studentdetails')}}',
                                'method':'get',
                                'data':"dept="+dept+"&sem="+sem,
                                'datatype':'json',
                                'success':function (data) {
                                    var c=1;
                                    // alert(data);
                                    data=JSON.parse(data);
                                    $('#table tbody').empty();
                                    data.forEach(function (item) {
                                        var route="{{route('students.edit','id')}}";
                                        route = route.replace('id', item.id);
                                        // alert(item.id);
                                        $('#table tbody').append('<tr>'+
                                            '<td>'+c+++'</td>'+
                                            '<td>'+item.usn+'</td>'+
                                            '<td>'+item.name+'</td>'+
                                            '<td>'+item.phone+'</td>'+
                                            '<td>'+item.dept+'</td>'+
                                            '<td><a class="btn btn-primary btn-block" href="'+route+'">Edit</a></td>'+
                                            '</tr>');
                                });

                                },
                                'error':function (data) {
                                    alert(data);
                                }


                            })
                        })
                        $('#sec').change(function () {
                            $('#print').hide();
                            // var sec=$('#sec').val();
                            var dept=$('#dept').val();
                            var sem=$('#sem').val();
                            var sec=$('#sec').val();
                            $('#subname').empty().append("<option selected disabled>Subject</option>");
                            $.ajax({
                                'url':'{{route('getsubject')}}',
                                'method':'get',
                                'datatype':'json',
                                cache:false,
                                'data':"dept="+dept+"&sem="+sem+"&sec="+sec,
                                'success':function (data) {
                                    data=JSON.parse(data);
                                    data.forEach(function (item) {
                                        $('#subname').append($('<option>', { value : item.subname }).text( item.subname));
                                    });

                                },
                                'error':function (data) {
                                    alert(data);
                                }


                            })
                            $.ajax({
                                'url':'{{route('studentdetails')}}',
                                'method':'get',
                                'data':"dept="+dept+"&sem="+sem+"&sec="+sec,
                                'datatype':'json',
                                'success':function (data) {
                                    var c=1;
                                    // alert(data);
                                    data=JSON.parse(data);
                                    $('#table tbody').empty();
                                    data.forEach(function (item) {
                                        var route="{{route('students.edit','id')}}";
                                        route = route.replace('id', item.id);
                                        // alert(item.id);
                                        $('#table tbody').append('<tr>'+
                                            '<td>'+c+++'</td>'+
                                            '<td>'+item.usn+'</td>'+
                                            '<td>'+item.name+'</td>'+
                                            '<td>'+item.phone+'</td>'+
                                            '<td>'+item.dept+'</td>'+
                                            '<td><a class="btn btn-primary btn-block" href="'+route+'">Edit</a></td>'+
                                            '</tr>');
                                });

                                },
                                'error':function (data) {
                                    alert(data);
                                }
                            })

                        })

                });
        </script>
    @endpush

@stop

