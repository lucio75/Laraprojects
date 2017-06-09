@extends('template.default')
@section('content')
<table class="table table-bordered">
    <tr>
      <th>ID</th>
        <th>CREATED DATE</th>
        <th>TITLE</th>
        <th>ALBUM</th>
        <th>THUMBNAIL</th>
    </tr>
    @forelse($images as $image)
        <tr>
            <td>{{$image->id}}</td>
            <td>{{$image->created_at}}</td>
            <td>{{$image->name}}</td>
            <td>{{$album->album_name}}</td>
            <td>
                <img width="120" src="{{asset($image->img_path)}}"/>
            </td>
            <td>
                <a href="{{route('photos.destroy',$image->id)}}"
                   class="btn btn-danger">DELETE</a>
            </td>
        </tr>
        @empty
            <tr><td colspan="5">
                    Not images found
                </td></tr>
            @endforelse
</table>
    @endsection

@section('footer')
    @parent
    <script>
        $('document').ready(function(){
            //$('div.alert').fadeOut(3000);
            $('table').on('click','a.btn-danger',function(e){
                e.preventDefault();
                var urlAlbum=$(this).attr('href');
                var tr = e.target.parentNode.parentNode;
                $.ajax(urlAlbum,
                        {
                            method: 'DELETE',
                            data :{
                                '_token' : '{{csrf_token()}}'
                            },
                            complete : function(resp){
                                console.log(resp);
                                if(resp.responseText == 1){
                                    //alert(resp.responseText);
                                    tr.parentNode.removeChild(tr);

                                }else{
                                    alert('Problem connecting server');
                                }
                            }
                        }
                )
            });
        });
    </script>
@endsection