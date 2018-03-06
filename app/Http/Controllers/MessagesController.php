<?php

namespace App\Http\Controllers;

use App\Message;
use App\Http\Requests\CreateMessageRequest;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function show(Message $message){
    	//ir a buscar el message por el parametro id y retornarlo a la vista
    	//$message = Message::find($id);

    	//tambien se puede hacer recibiendo como parametro el objeto mensaje, en la ruta recibe el id pero internamente lo trata como un objeto e igual devuelve el mismo resultado

    	//La diferencia está en que enviando el parametro message laravel si no encuentra el registro, trata el error como PageNotFound, mientras que por id da un error diferente y habría que darle tratamiento nosotros mismos
    	
    	return view('messages.show', ['message' => $message]);
    }

    public function create(CreateMessageRequest $request){

        $user = $request->user();
        $image = $request->file('image');

    	$message = Message::create([
            'user_id' => $user->id,
    		'content' => $request->input('message'),
    		'image' => $image->store('messages', 'public') //'http://lorempixel.com/600/338?' . mt_rand(0, 1000)
    	]);

    	return redirect('messages/' . $message->id);
    	
    }

    public function search(Request $request){
        $query = $request->input('query');

        $messages = Message::with('user')->where('content', 'LIKE', "%$query%")->paginate(10);

        return view('messages.index', [
            'messages' => $messages,
        ]);
    }
}
