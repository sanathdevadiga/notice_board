@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>

@stop
@section('content')
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
            <select name="type" id="type" class="form-control col-md-1 offset-1">
                <option value="" selected disabled>Type</option>
            </select>
            <select name="internal" id="internal" class="form-control col-md-1 offset-1">
                <option value="" selected disabled>Internal</option>
            </select>
        </div>
    </form>
    <table class="table table-hover mt-4" id="table">
        <thead>
            <tr>
                <!-- <th>Mark</th> -->
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <button class="btn btn-success" id="print">Print</button>
    @push('js')
        <script>
        var subject_size;
            $(document).ready(
                function()
                {
                    $('#internal').hide();
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
                    $('#dept').change(
                        function() {
                            var dept=$('#dept').val();
                            // var sem=$('#sem').val();
                            // var sec=$('#sec').val();
                            $('#internal').hide();
                            $('#sem').empty().append("<option selected disabled>Sem</option>");
                            $('#sec').empty().append("<option selected disabled>Sec</option>");
                            $('#internal').empty().append("<option selected disabled>Internal</option>");
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
                            $('#internal').hide();
                            var dept=$('#dept').val();
                            var sem=$('#sem').val();
                            // var sec=$('#sec').val();
                            $('#sec').empty().append("<option selected disabled>Sec</option>");
                            $('#internal').empty().append("<option selected disabled>Internal</option>");
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
                    $('#sec').change(function () {
                        $('#internal').hide();
                        $('#type').empty().append("<option selected disabled>Type</option>");
                        $('#type').append("<option value='attendance'>Attendance</option>");
                        $('#type').append("<option value='marks'>Marks</option>");
                    });
                    var subjects;
                    $('#type').change(
                        function() {
                            $('#internal').hide();
                            var dept=$('#dept').val();
                            var sem=$('#sem').val();
                            var sec=$('#sec').val();
                            var type=$('#type').val();
                            var count=1;
                            $('#table tbody tr').remove();
                            $('#table thead tr').empty().append('<th>SI No.</th><th>USN</th><th>Name</th>');
                            $.ajax({
                                'url':'{{route('getallsubject')}}',
                                'method':'get',
                                'datatype':'json',
                                cache:false,
                                'data':"dept="+dept+"&sem="+sem+"&sec="+sec+"&type="+type,
                                'success':function (data) {
                                    data=JSON.parse(data);
                                    subjects=data;
                                    // alert(subjects[0].id);
                                    subject_size=data.length;
                                    data.forEach(function (item) {
                                        // $('#subname').append($('<option>', { value : item.subname }).text( item.subname));
                                        $('#table thead tr').append('<th>'+item.subname+'</th>');
                                    });
                                },
                                'error':function (data) {
                                    alert(data);
                                }
                            })
                            if(type=='marks'){
                                $('#internal').empty().append("<option selected disabled>Internal</option>");
                                $('#internal').append("<option value='1'>1</option>");
                                $('#internal').append("<option value='2'>2</option>");
                                $('#internal').append("<option value='3'>3</option>");
                                $('#subname').empty().append("<option selected disabled>Subject</option>");
                                $('#internal').show();
                            }
                            else if(type=='attendance'){
                                $.ajax({
                                    'url':'{{route('getallmarks')}}',
                                    'method':'get',
                                    'datatype':'json',
                                    cache:false,
                                    'data':"dept="+dept+"&sem="+sem+"&sec="+sec+"&type="+type,
                                    'success':function (data) {
                                        // alert(data);
                                        data=JSON.parse(data);
                                        var c=0;
                                        var value='';
                                        var usn;
                                        var i;
                                        for(c=0;c<data.length;c++) {
                                            usn=data[c].usn;
                                            // alert(c);
                                            value += '<tr>'+
                                                '<td>'+count+++'</td>'+
                                                '<td>'+data[c].usn+'</td>'+
                                                '<td>'+data[c].name+'</td>';  
                                                size=c+subject_size; 
                                                i=0;
                                                while(c<size&&c<data.length){
                                                    if(data[c].usn!=usn){
                                                        break;
                                                    }
                                                    if(data[c].subject_id==subjects[i].id){
                                                        value+='<td>'+Math.abs(data[c].percentage)+'%</td>';
                                                        c++;
                                                    }
                                                    else{
                                                        value+='<td>0%</td>';
                                                    }
                                                    i++;
                                                }
                                                while(i++<subject_size){
                                                    value+='<td>0%</td>';
                                                }
                                                c--;
                                                // var i=c;
                                                // var size=c+subject_size;
                                                // for(i=0;;i++){
                                                //     if(data[c].usn!=usn){
                                                //         break;
                                                //     }
                                                //     if(data[c].subject_id==subjects[i-c].id){
                                                //         // alert(subjects[1].id);
                                                //         value+='<td>'+Math.abs(data[i].percentage)+'%</td>';
                                                //         c++;
                                                //     }
                                                //     else{
                                                //         value+='<td>0%</td>';
                                                //     }
                                                // }
                                                // c--;
                                                // for(i=c;i<size;i++){
                                                //     value+='<td>0%</td>';
                                                // }
                                                value+='</tr>';
                                        }
                                        $('#table tbody').append(value);

                                    },
                                    'error':function (data) {
                                        alert(data);
                                    }
                                })

                            }
                         }
                    )


                    $('#internal').change(function () {
                        var dept=$('#dept').val();
                            var sem=$('#sem').val();
                            var sec=$('#sec').val();
                            var type=$('#type').val();
                            var count=1;
                            var internal=$('#internal').val();
                            $('#table tbody tr').remove();
                            $.ajax({
                                'url':'{{route('getallmarks')}}',
                                'method':'get',
                                'datatype':'json',
                                cache:false,
                                'data':"dept="+dept+"&sem="+sem+"&sec="+sec+"&internal="+internal+"&type="+type,
                                'success':function (data) {
                                    alert(data);
                                    data=JSON.parse(data);
                                    var c=0;
                                    var value='';
                                    for(c=0;c<data.length;c++) {
                                        value += '<tr>'+
                                            '<td>'+count+++'</td>'+
                                            '<td>'+data[c].usn+'</td>'+
                                            '<td>'+data[c].name+'</td>';
                                            var i=c;
                                            c+=subject_size;
                                            for(;i<c;i++){
                                            value+='<td>'+data[i].mark+'</td>';
                                            }
                                            c--;
                                            value+='</tr>';
                                    }
                                    $('#table tbody').append(value);

                                },
                                'error':function (data) {
                                    alert(data);
                                }


                            })

                    });
                    
                    $('#print').click(
                        function() {
                            var dept=$('#dept').val();
                            var sem=$('#sem').val();
                            var sec=$('#sec').val();
                            // var subname=$('#subname').val();
                            var type=$('#type').val();
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
                            if(type=='marks'){
                                win.document.write("<h4 style='float:right'>"+internal+"</h4>");
                            }
                            win.document.write("<table>");
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
