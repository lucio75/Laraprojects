@extends('template.default')
@section('content')
    <h1>NEW ALBUM</h1>
    @include('partial.inputerrors')
    <form action="{{route('albums.save')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" name="name" id="name" value="" class="form-control"
                       placeholder="Album name" aria-describedby="helpId">

        </div>
        @include('albums.partial.fileUpload')
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="description" id="description" class="form-control"
                          placeholder="Description" aria-describedby="helpId">

            </textarea>

        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
@stop