<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class PagesController extends Controller
{
    public function home(){
		//$messages = Message::all(); Trae todo los registros

		$messages = Message::paginate(10);

		//dd($messages);
		//Esta funcion es la equivalente al vardump de php
		
	    return view('welcome', [
	    	'messages' => $messages,
	    ]);
    }
}
