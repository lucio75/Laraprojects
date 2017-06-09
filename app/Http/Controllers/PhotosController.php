<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;

use LaraCourse\Models\Photo;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response|static[]
     */
    public function index()
    {
        return Photo::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Photo
     */
    public function show(Photo $photo)
    {
       return $photo;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $photo->img_path = env('IMG_DIR') .$photo->album_id .'/'.$fileName;
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

}