<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class PagesController extends Controller
{
    public function home(){
		$messages = Message::all();

		//dd($messages);
		//Esta funcion es la equivalente al vardump de php
		
	    return view('welcome', [
	    	'messages' => $messages,
	    ]);
    }
}
