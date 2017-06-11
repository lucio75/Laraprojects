<?php

//use LaraCourse\Models\Album;

use LaraCourse\Models\Photo;

use LaraCourse\User;

Route::get('/','Homecontroller@index');

Route::get('welcome/{name?}/{lastname?}/{age?}', 'welcomeController@welcome')

/*
	->where('name','[a-zA-Z]+')
	->where('lastname','[a-zA-Z]+');
*/

	->where([

		'name'=>'[a-zA-Z]+',
		'lastname'=>'[a-zA-Z]+',
		'age'=>'[0-9]{1,3}'
		]);

Route::get('/photos',function(){
    return Photo::all();
});



Route::get('/albums','AlbumsController@index')->name('albums');

Route::get('/albums/create','AlbumsController@create')->name('albums.create');

Route::post('/albums/create','AlbumsController@save')->name('albums.save');

Route::get('/albums/{album}/images','AlbumsController@getImages')
    ->name('album.getImages')
    ->where('album','[0-9]+');

Route::get('/albums/{id}','AlbumsController@show')->where('id','[0-9]+');

Route::delete('/albums/{album}','AlbumsController@delete')
->where('id','[0-9]+');

Route::get('/albums/{id}/edit','AlbumsController@edit');

Route::patch('/albums/{id}','AlbumsController@store');


Route::get('/users',function(){
    return User::all();
});

Route::get('usersnoalbums',function(){
    $usersnoalbum= DB::table('users as u')
        ->leftjoin('albums as a','u.id','a.user_id')
        ->select('u.id','email','album_name')
        ->whereRaw('album_name is null')
        ->get();
    return $usersnoalbum;
});

//images
Route::resource('photos','PhotosController');
