@extends('adminlte::page')

@section('title','AdminLTE')

@section('content_header')
    <h1></h1>

@stop
@section('content')
<h2 style="text-align:center">Welcome to Office Page</h2><br>

    <div class="conatiner col-md-6 m-auto">
        <div class="card">
            <div class="card-head bg-primary">
                <h2 class="text-center m-3">Event</h2>
            </div>
            <div class="card-body">
                <form action="{{route('events.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div> -->
                    <div class="form-group">
                        <label for="title">Image</label>
                        <div id="img-box" style="height: 200px;width: 100%;cursor: pointer;box-shadow: 5px 5px 10px black;padding: 10px">
                            <img src="" id="preview" alt="image" height="100%" style="display: block;margin: auto">
                        </div>
                        <input type="file" hidden="hidden" class="form-control" name="image" id="image" required>
                    </div>
                    <div class="form-group">
                        <label for="title">End Date</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                  <!--  <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="6" style="resize: none" required></textarea>
                    </div> -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(
                function()
                {
                    $('#img-box').click(function () {
                        $('#image').click();
                    })
                    $('#image').change(function (event) {
                        if (event) {
                            $('#preview').attr('src',URL.createObjectURL(event.target.files[0]));
                        }
                    });
                }
            );
        </script>

    @endpush


@stop

