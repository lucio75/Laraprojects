<?php

namespace LaraCourse\Http\Controllers;

use Illuminate\Http\Request;

class welcomeController extends Controller
{
  public function welcome($name='',$lastname='',$age='0',Request $req){
  	$language=$req->input('lang');
  	 $res='<h1>Hello world'.' '.$name.' '.$lastname.' you are  '.$age.' old. Your language is'. $language.'</h1>';
  	return $res;
  }
  


}
