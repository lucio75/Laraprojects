<div class="form-group">
    <label for="Name">Thumbnail</label>
    <input type="file" name="album_thumb" id="album_thumb" value="{{$album->album_name}}" class="form-control"
           placeholder="Album name" aria-describedby="helpId">

</div>
@if($album->album_thumb)

    <div class="form-group">
        <img width="200" src="{{asset($album->path)}}" alt="{{$album->album_name}}"
             title="{{$album->album_name}}"/>

    </div>
@endif