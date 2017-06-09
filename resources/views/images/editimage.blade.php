@extends('template.default')
@section('content')
    <h1>NEW PHOTO</h1>
    <form action="{{route('photos.update',$photo->id)}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}{{method_field('PATCH')}}
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" name="name" id="name" value="{{$photo->name}}" class="form-control"
                   placeholder="Photo name" aria-describedby="helpId">

        </div>
        <input type="hidden" name="album_id" value="$photo->album_id">
        @include('images.partial.fileUpload')
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea name="description" id="description" class="form-control"
                      placeholder="Description" aria-describedby="helpId">
        {{$photo->description}}
            </textarea>

        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
@stop