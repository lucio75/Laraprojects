@extends('template.default')
@section('content')
    <h1>
        @if($photo->id)
            UPDATE IMAGE
            @else
        NEW IMAGE

            @endif
    </h1>


    @if($photo->id)
    <form action="{{route('photos.update',$photo->id)}}" method="post" enctype="multipart/for@include('partial.inputerrors')m-data">
        {{method_field('PATCH')}}
        @else
            <form action="{{route('photos.store')}}" method="post" enctype="multipart/form-data">
                @endif
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" name="name" id="name" value="{{$photo->name}}" class="form-control"
                   placeholder="Photo name" aria-describedby="helpId">

        </div>
                <div class="form-group">
                    <select class="form-control" required name="album_id" id="album_id">
                        <option value="">SELECT</option>
                        @foreach($albums as $item)
                            <option {{$item->id==$album->id?'selected' :''}} value="{{$item->id}}">{{$item->album_name}}</option>
                        @endforeach
                    </select>


                </div>
        @include('images.partial.fileUpload')
                {{csrf_field()}}
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