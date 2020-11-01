@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>

@stop
@section('content')
<h2 style="text-align:center">Welcome to Lecturer Page</h2><br>

    <form action="">
        <div class="row">
            <select name="dept" id="dept" class="form-control col-md-1 offset-1">
                <option value="dept" selected disabled>Dept</option>
            </select>
            <select name="sem" id="sem" class="form-control col-md-1 offset-1">
                <option value="sem" selected disabled>Sem</option>
            </select>
            <select name="sec" id="sec" class="form-control col-md-1 offset-1">
                <option value="sec" selected disabled>Sec</option>
            </select>
            <select name="subname" id="subname" class="form-control col-md-1 offset-1">
                <option value="sec" selected disabled>Subject</option>
            </select>
            <select name="internal" id="internal" class="form-control col-md-1 offset-1">
                <option value="" selected disabled>Internal</option>
            </select>
            <input type="number" placeholder="Max" id="max" class="form-control col-md-1 offset-1" min="0">
        </div>
    </form>
    {!! Form::open(['route' => 'marks.store', 'method' => 'post']) !!}
    <table class="table table-hover mt-4" id="table">
        <thead>
        <tr>
            <th>SI No.</th>
            <th>USN</th>
            <th>Name</th>
            <th>Mark</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    {!! Form::submit('Submit', ['class' => 'form-control','id'=>'submit']) !!}
    {!! Form::close() !!}
@stop
@push('js')
    <script>
        $(document).ready(
            function () {
                $('#submit').hide();
                $('#max').keyup(function () {
                    $('.mark').filter(function(){
                        return $(this).val()>$('#max').val();
                    }).css('color','red');
                    $('.mark').filter(function(){
                        return $(this).val()<=$('#max').val();
                    }).css('color','black');
                })
                $('#dept').empty().append("<option selected disabled>Dept</option>");
                $.ajax({
                    'url':'{{route('getdept')}}',
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
                $('#dept').change(
                    function () {
                        $('#submit').hide();
                        var dept = $('#dept').val();
                        // var sem=$('#sem').val();
                        // var sec=$('#sec').val();
                        $('#sem').empty().append("<option selected disabled>Sem</option>");
                        $('#sec').empty().append("<option selected disabled>Sec</option>");
                        $.ajax({
                            'url': '{{route('getsem')}}',
                            'method': 'get',
                            'datatype': 'json',
                            'data': "dept=" + dept,
                            'success': function (data) {
                                data = JSON.parse(data);
                                data.forEach(function (item) {
                                    $('#sem').append($('<option>', {value: item.sem}).text(item.sem));
                                });

                            },
                            'error': function (data) {
                                alert(data);
                            }


                        })
                    }
                );
                $('#sem').change(
                    function () {
                        $('#submit').hide();
                        var dept = $('#dept').val();
                        var sem = $('#sem').val();
                        // var sec=$('#sec').val();
                        $('#sec').empty().append("<option selected disabled>Sec</option>");
                        $.ajax({
                            'url': '{{route('getsec')}}',
                            'method': 'get',
                            'datatype': 'json',
                            cache: false,
                            'data': "dept=" + dept + "&sem=" + sem,
                            'success': function (data) {
                                data = JSON.parse(data);

                                data.forEach(function (item) {
                                    $('#sec').append($('<option>', {value: item.sec}).text(item.sec));
                                });

                            },
                            'error': function (data) {
                                alert(data);
                            }


                        })
                    }
                )
                $('#sec').change(function () {
                    // var sec=$('#sec').val();
                    var dept=$('#dept').val();
                    var sem=$('#sem').val();
                    var sec=$('#sec').val();
                    $('#submit').hide();
                    $('#subname').empty().append("<option selected disabled>Subject</option>");
                    $.ajax({
                        'url':'{{route('getstaffsubject')}}',
                        'method':'get',
                        'datatype':'json',
                        cache:false,
                        'data':"dept="+dept+"&sem="+sem+"&sec="+sec,
                        'success':function (data) {
                            // alert(data);

                            data=JSON.parse(data);
                            // alert(data);
                            data.forEach(function (item) {
                                $('#subname').append($('<option>', { value : item.subname }).text( item.subname));
                            });

                        },
                        'error':function (data) {
                            alert(data);
                        }


                    })

                });

                $('#subname').change(function () {
                    $('#submit').hide();
                    $('#internal').empty().append("<option selected disabled>Internal</option>");
                    $('#internal').append("<option value='1'>1</option>");
                    $('#internal').append("<option value='2'>2</option>");
                    $('#internal').append("<option value='3'>3</option>");
                });

                $('#internal').change(
                    function () {
                        $('#submit').show();
                        var dept = $('#dept').val();
                        var sem = $('#sem').val();
                        var sec = $('#sec').val();
                        var subname = $('#subname').val();
                        var internal = $('#internal').val();
                        $('#table tbody tr').remove();
                        $.ajax({
                            'url': '{{route('putmarks')}}',
                            'method': 'get',
                            'datatype': 'json',
                            cache: false,
                            'data': "dept=" + dept + "&sem=" + sem + "&sec=" + sec+'&subname='+subname+'&internal='+internal,
                            'success': function (data) {
                                alert(data);
                                data = JSON.parse(data);
                                var c = 1;
                                data.forEach(function (item) {
                                    $('#table tbody').append('<tr>' +
                                        '<td>' + c++ + '</td>' +
                                        '<td>' + item.usn + '</td>' +
                                        '<td>' + item.name + '</td>' +
                                        '<td><input type="number" class="form-control mark" min="0" name="' + item.id + '" value="'+item.mark+'"></td>' +
                                        '</tr>');
                                });
                                $('.mark').keyup(function () {
                                    if ($('#max').val() == 0) {
                                        alert('Set maximum value');
                                        $(this).val('');
                                    }
                                    if (parseInt($('#max').val()) < parseInt($(this).val())) {

                                        alert('Exceeding maximum limit');
                                        $(this).val(parseInt($('#max').val()));
                                    }
                                    $(this).css('color','black');
                                })
                                
                            },
                            'error': function (data) {
                                alert(data);

                            }


                        })
                     
                    }
                )


            }

        );
    </script>
@endpush
