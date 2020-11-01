@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>

@stop
@section('content')
<h2 style="text-align:center">Welcome to Office Page</h2><br>

    <div class="container col-md-6">
        <div class="card">
            <div class="card-header bg-cyan">
                <h4 class="text-center">Student Information</h4>
            </div>
            <div class="card-body">
               {!!  Form::model($student,['route' => ['students.update',$student->id],'method'=>'put']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                        {!! Form::text('name',null, ['class' => ['form-control'],'required'=>true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('usn', 'USN', ['class' => 'control-label']) !!}
                        {!! Form::text('usn',null, ['class' => ['form-control'],'required'=>true,'readonly'=>true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('dob', 'DOB', ['class' => 'control-label']) !!}
                        {!! Form::date('dob',null, ['class' => ['form-control'],'required'=>true,'readonly'=>true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', 'Ph No.', ['class' => 'control-label']) !!}
                        {!! Form::tel('phone',null, ['class' => ['form-control'],'required'=>true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                        {!! Form::email('email',null, ['class' => ['form-control'],'required'=>true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('gname', 'Guardian', ['class' => 'control-label']) !!}
                        {!! Form::text('gname',null, ['class' => ['form-control'],'required'=>true]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('gphone', 'Guardian Ph', ['class' => 'control-label']) !!}
                        {!! Form::tel('gphone',null, ['class' => ['form-control'],'required'=>true]) !!}
                    </div>
                <div class="form-group">
                    {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
                    {!! Form::textarea('address',null, ['class' => ['form-control'],'required'=>true]) !!}
                </div>
                    <div class="row">
                        {!! Form::select('dept',$depts->pluck('dept','dept') , $student->department->dept , ['class' =>[ 'form-control','col-md-3'],'id'=>'dept']) !!}
                        {!! Form::select('sem',$depts->pluck('sem','sem'), $student->department->sem, ['class' =>[ 'form-control','col-md-4', 'offset-1'],'id'=>'sem']) !!}
                        {!! Form::select('sec', $depts->pluck('sec','sec') , $student->department->sec , ['class' =>[ 'form-control','col-md-3', 'offset-1'],'id'=>'sec']) !!}
{{--                        <select name="" id="2" class="form-control col-md-4 offset-1">--}}
{{--                            <option value="" selected disabled>CS</option>--}}
{{--                            <option value="">IS</option>--}}
{{--                        </select>--}}
{{--                        <select name="" id="3" class="form-control col-md-3 offset-1">--}}
{{--                            <option value="" selected disabled>CS</option>--}}
{{--                            <option value="">IS</option>--}}
{{--                        </select>--}}
                    </div>
                <div class="form-group">
                    {!! Form::submit('Submit', ['class' => 'mt-2 btn btn-primary btn-block']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(
                function()
                {
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

