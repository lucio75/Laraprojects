@extends('template.default')
@section('content')
<h1>EDIT ALBUM</h1>
    <form action="/albums/{{$album->id}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
            <label for="Name">Name</label>
                <input type="text" name="name" id="name" value="{{$album->album_name}}" class="form-control"
                placeholder="Album name" aria-describedby="helpId">

        </div>
        @include('albums.partial.fileUpload')

        <div class="form-group">
            <label for="Description">Description</label>
                <textarea name="description" id="description" class="form-control"
                       placeholder="Description" aria-describedby="helpId">
                    {{$album->description}}
                </textarea>

        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
@stop