@extends('template.default')

@section('content')
    <h1>ALBUMS</h1>
    @if(session()->has('message'))
        @component('components.alert-info')
            {{session()->get('message')}}
        @endcomponent
        @endif
    <form>
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item justify-content-between">({{$album->id}})
                {{$album->album_name}}
                <div>
                    @if($album->album_thumb)
                        <img width="90" src="{{asset($album->path)}}" alt="{{$album->album_name}}"
                             title="{{$album->album_name}}"/>
                    @if($album->photos_count)
                        <a href="/albums/{{$album->id}}/images
                        " class="btn btn-primary">VIEW IMAGES ({{$album->photos_count}})</a>
                        @endif
                <a href="/albums/{{$album->id}}/edit
                        " class="btn btn-primary">UPDATE</a>
                <a href="/albums/{{$album->id}}
                        " class=" delete btn btn-danger">DELETE</a>
                        @endif
                </div>
               </li>
        @endforeach
        </ul>
    </form>
    <tr>
        <td colspan="6" class="text-center">
            <div class="row">
                <div class="col-md-3 push-9">
                    {{$albums->links('vendor.pagination.bootstrap-4')}}
                </div>
            </div>
        </td>
    </tr>
@endsection

@section('footer')
@parent
    <script>
        $('document').ready(function(){
            $('div.alert').fadeOut(3000);
            $('ul').on('click','a.delete',function(e){
                e.preventDefault();
                var urlAlbum=$(this).attr('href');
                var li = e.target.parentNode.parentNode;
                $.ajax(urlAlbum,
                        {
                          method: 'DELETE',
                            data :{
                                '_token' : $('#_token').val()
                            },
                          complete : function(resp){
                              console.log(resp);
                            if(resp.responseText == 1){
                                alert(resp.responseText);
                                li.parentNode.removeChild(li);

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