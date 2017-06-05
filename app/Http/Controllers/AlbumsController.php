<?php
namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;
use LaraCourse\Models\Album;
use DB;
use LaraCourse\Models\Photo;
use Storage;
class AlbumsController extends Controller
{
    public function index(Request $request){

       $queryBuilder= Album::orderBy ('id','DESC')->withCount('photos');
        if($request->has('id')){
            $queryBuilder->where('id','=',$request->input('id'));
        }
        if($request->has('album_name')){
            $queryBuilder->where('album_name','like','%'.$request->input('album_name').'%');
        }
        $album=$queryBuilder->get();
        return view('albums.albums',['albums'=> $album]);

    }

    public function delete(Album $album){
        $thumbnail=$album->album_thumb;
        $disk=config('filesystems.default');
        $res = $album->delete();

        if($res){
            if($thumbnail && Storage::disk($disk)->has($thumbnail)){
                Storage::disk($disk)->delete($thumbnail);
            }
        }

        return ''.$res;

    }

    public function edit($id){

        $album=Album::find($id);

        return view('albums.edit')->with('album',$album);
    }

    /**
     * @param $id
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($id, Request $req){

       $album=Album::find($id);
        $album->album_name = request()->input('name');
        $album->description = request()->input('description');
        $album->user_id=1;
        $this->processFile($id, $req, $album);
        $res=$album->save();
        $messaggio = $res ? 'Album con id= '. $id.' aggiornato' :
            'Album '. $id.' non aggiornato';
        session()->flash('message',$messaggio);
       return redirect()->route('albums');

    }


    public function create(){
        $album=new Album();
        return view('albums.createalbum',['album'=>$album]);
    }

    public function save(){

        $album = new Album();
        $album->album_name = request()->input('name');
        $album->album_thumb ='';
        $album->description = request()->input('description');
        $album->user_id = 1;

        $res=$album->save();
        if($res){
            if($this->processFile($album->id, request(), $album)){
              $album->save();
            }
        }

        $name = request()->input('name');
        $messaggio = $res ? 'Album '. $name .' Created' :
            'Album '. $name.' was not created';
        session()->flash('message',$messaggio);
        return redirect()->route('albums');
    }

    /**
     * @param $id
     * @param Request $req
     * @param $album
     */
    public function processFile($id, Request $req, &$album):bool
    {
        if(!$req->hasFile('album_thumb')){

        return false;
        }

        $file = $req->file('album_thumb');

            if(!$file->isValid()){

                return false;
            }

                $fileName = $id . '.' . $file->extension();
                $file->storeAs(env('ALBUM_THUMB_DIR'), $fileName);
                $album->album_thumb = env('ALBUM_THUMB_DIR') . '/' . $fileName;

            return true;
    }

    public function getimages(album $album){

       $images=Photo::where('album_id',$album->id)->get();
        return view('images.albumimages',compact('album','images'));
    }

}
