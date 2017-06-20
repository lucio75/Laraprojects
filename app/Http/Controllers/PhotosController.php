<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;

use LaraCourse\Models\Album;

use LaraCourse\Models\Photo;

use Storage;
class PhotosController extends Controller
{
    protected $rules = [
        'album_id' => 'required|integer|exists:albums,id',
        'name' => 'required',
        'description' => 'required',
        'img_path' => 'required|image'
    ];

    protected $errorMessages = [
        'album_id.required' => 'Il campo Album è obbligatorio',
        'description.required' => 'Il campo Descrizione è obbligatorio',
        'name.required' => 'Il campo Nome è obbligatorio',
        'img_path.required' => 'Il campo Immagine è obbligatorio'
    ];
    public function index()
    {
        return Photo::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $id=$req->has('album_id')?$req->input('album_id'):null;

        $album=Album::firstOrNew(['id'=>$id]);

        $photo=new Photo();
        $albums = $this->getAlbums();
        return view('images.editimage',compact('albums','album','photo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, $this->rules,$this->errorMessages);

        $photo = new Photo();
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $photo->album_id = $request->input('album_id');


        $this->processFile($photo);
        $photo->save();
        return redirect(route('album.getImages',$photo->album_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Photo
     */
    public function show(Photo $photo)
    {
       dd($photo) ;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $albums=$this->getAlbums();
        $album = $photo->album;
        return view('images.editimage',compact('album','albums','photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $this->validate($request, $this->rules,$this->errorMessages);
        $this->processFile($photo);
        $photo->album_id= $request->album_id;
        $photo->name=$request->input('name');
        $photo->description=$request->input('description');
        $res=$photo->save();

        $messaggio = $res ? 'Image '. $photo->name .' Updated' :
            'Image '. $photo->name.' was not updated';
        session()->flash('message',$messaggio);
        return redirect()->route('album.getImages', $photo->album_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $res =  $photo->delete();
        if($res){
            $this->processFile($photo) ;
        }
        return ''.$res;
    }
    public function processFile(Photo &$photo,  Request $req= null )
    {
        if(!$req){
            $req = request();
        }
        if(!$req->hasFile('img_path') ){
            return false;
        }
        $file = $req->file('img_path');
        if(!$file->isValid()){
            return false;
        }
        //$fileName = $file->store(env('ALBUM_THUMB_DIR'));
        $imgName = preg_replace("@\W@",'_', $photo->name);

        $fileName = $imgName. '.' . $file->extension();
        $file->storeAs(env('IMG_DIR').'/'.$photo->album_id, $fileName);
        $photo->img_path = env('IMG_DIR').'/'.$photo->album_id .'/'.$fileName;
        return  true;
    }
    public function deleteFile(Photo $photo)
    {
        $disk = config('filesystems.default');
        if($photo->img_path && Storage::disk($disk)->has($photo->img_path)){
            return   Storage::disk($disk)->delete($photo->img_path);
        }
        return false;
    }

    public function getAlbums()
    {
        return Album::orderBy('album_name')->get();
    }


}