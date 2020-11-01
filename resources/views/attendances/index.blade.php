@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>

@stop
@section('content')
<h2 style="text-align:center">Welcome to Lecturer Page</h2><br>


    <form action="">
        <div class="row">
            <select name="dept" id="dept" class="form-control col-md-1 offset-2">
                <option value="dept" selected disabled>Dept</option>
            </select>
            <select name="sem" id="sem" class="form-control col-md-1 offset-1">
                <option value="sem" selected disabled>Sem</option>
            </select>
            <select name="sec" id="sec" class="form-control col-md-1 offset-1">
                <option value="sec" selected disabled>Sec</option>
            </select>
            <select name="subname" id="subname" class="form-control col-md-2 offset-1">
                <option value="subject" selected disabled>Subject</option>
            </select>
        </div>
    </form>

    <table class="table table-hover mt-4" id="table">
        <thead>
        <tr>
            <th>SI No.</th>
            <th>USN</th>
            <th>Name</th>
            <th>Attendance</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <button class="btn btn-success" id="print">Print</button>
    @push('js')
        <script>
            $(document).ready(
                function()
                {
                    $('#print').hide();
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
                        function() {
                             $('#print').hide();
                            var dept=$('#dept').val();
                            // var sem=$('#sem').val();
                            // var sec=$('#sec').val();
                            $('#sem').empty().append("<option selected disabled>Sem</option>");
                            $('#sec').empty().append("<option selected disabled>Sec</option>");
                            $('#subname').empty().append("<option selected disabled>Subject</option>");
                            $.ajax({
                                'url':'{{route('getsem')}}',
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
                            $('#print').hide();
                            var dept=$('#dept').val();
                            var sem=$('#sem').val();
                            // var sec=$('#sec').val();
                            $('#sec').empty().append("<option selected disabled>Sec</option>");
                            $.ajax({
                                'url':'{{route('getsec')}}',
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
                    $('#sec').change(
                        function() {
                            $('#print').hide();
                            var dept=$('#dept').val();
                            var sem=$('#sem').val();
                            var sec=$('#sec').val();
                            $('#subname').empty().append("<option selected disabled>Subject</option>");
                            $.ajax({
                                'url':'{{route('getstaffsubject')}}',
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
                        }
                    )
                    $('#subname').change(
                    function() {
                        $('#print').show();
                        var dept=$('#dept').val();
                        var sem=$('#sem').val();
                        var sec=$('#sec').val();
                        var subname=$('#subname').val();
                        $('#table tbody tr').remove();
                        $.ajax({
                            'url': '{{route('getattend')}}',
                            'method': 'get',
                            'datatype': 'json',
                            cache: false,
                            'data': "dept=" + dept + "&sem=" + sem + "&sec=" + sec +"&subname="+subname,
                            'success': function (data) {
                                alert(data);
                                data = JSON.parse(data);
                                var c = 1;
                                data.forEach(function (item) {
                                    $('#table tbody').append('<tr>' +
                                        '<td>' + c++ + '</td>' +
                                        '<td>' + item.usn + '</td>' +
                                        '<td>' + item.name + '</td>' +
                                        '<td>' + parseInt(item.count * 100) + '%</td>' +
                                        '</tr>');
                                });

                            },
                            'error': function (data) {
                                alert(data);
                            }
                        })

                        })
                        $('#print').click(
                        function() {
                            var dept=$('#dept').val();
                            var sem=$('#sem').val();
                            var sec=$('#sec').val();
                            var subname=$('#subname').val();
                            var internal=$('#internal').val();
                            var table=document.getElementById("table").innerHTML;
                            var style="<style>";
                            style += "title{font:20px;} table {width:100%;font:17px Calibri}";
                            style += "table,th,td{border:1px solid black;border-collapse:collapse;";
                            style += "padding:10px 0px;text-align:center;}";
                            style += "</style>";
                            var title="";
                            var win=window.open('','','height=700,width=700');
                            win.document.write("<html><head>");
                            win.document.write("<title></title>");
                            win.document.write(style);
                            win.document.write("</head>");
                            win.document.write("<body><h4 style='float:left'>"+dept+" "+sem+" "+sec+"</h4>");
                            win.document.write("<h4 style='float:right'>"+subname+"</h4><table>");
                            win.document.write(table);
                            win.document.write("</table></body></html>");

                            win.document.close();
                            win.print();
                        }
                    )
                }
            );
        </script>

    @endpush

@stop


