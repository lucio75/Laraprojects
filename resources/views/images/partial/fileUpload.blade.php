<div class="form-group">
    <label for="Name">Thumbnail</label>
    <input type="file" name="img_path" id="img_path" value="{{$photo->name}}" class="form-control"
           placeholder="Photo name" aria-describedby="helpId">

</div>
@if($photo->img_path)

    <div class="form-group">
        <img width="200" src="{{asset($photo->img_path)}}" alt="{{$photo->name}}"
             title="{{$photo->name}}"/>

    </div>
@endif