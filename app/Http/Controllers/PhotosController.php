<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;

use LaraCourse\Models\Photo;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
    public function edit($id)
    {
        //
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
        $photo=$photo->delete();
        if($res){
            $this->processFile($photo->id)
        }
        //return Photo::destroy($id);
    }

    public function processFile( Photo $photo &$photo,Request $req=null)
    {
        if(!$req->hasFile('img_paths')){

            return false;
        }

        $file = $req->file('album_thumb');

        if(!$file->isValid()){

            return false;
        }

        $fileName = $id . '.' . $file->extension();
        $file->storeAs(env('IMG_DIR'), $fileName);
        $album->album_thumb = env('ALBUM_THUMB_DIR') . '/' . $fileName;

        return true;
    }
}
