<?php

namespace App\Http\Controllers;

use App\User;
use App\Conversation;
use App\PrivateMessage;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($username){
    	$user = $this->findByUsername($username);

    	return view('users.show', [
    		'user' => $user
    	]);
    }

    public function follow($username, Request $request){
		$user = $this->findByUsername($username); //Busco el id de usuario por su username

		$me = $request->user();//Me busco a mi mismo como usuario logueado

		$me->follows()->attach($user);

		return redirect("/$username")->withSuccess('Usuario seguido!');
    }

    public function unfollow($username, Request $request){
		$user = $this->findByUsername($username);

		$me = $request->user();

		$me->follows()->detach($user);

		return redirect("/$username")->withSuccess('Usuario no seguido!');
    }

    public function follows($username){
    	$user = $this->findByUsername($username);

    	return view('users.follows', [
    		'user' => $user
    	]);
    }

    public function followed($username){
    	$user = $this->findByUsername($username);

    	return view('users.followed', [
    		'user' => $user,
    	]);
    }

    public function sendPrivateMessage($username, Request $request){
        $user = $this->findByUsername($username);

        $me = $request->user();
        $message = $request->input('message');

        $conversation = Conversation::between($me, $user);

        /*
        Ya no necesitamos crearla porque el metodo between se encarga de crearla si no existe:
        $conversation = Conversation::create(); //Se crea la conversacion
        $conversation->users()->attach($me);    //Me agrego a mi mismo a la conversacion
        $conversation->users()->attach($user);  //Se agrega el usuario al que se le está enviando el mensaje
        */
        
        $privateMessage = PrivateMessage::create([
            'conversation_id' => $conversation->id,
            'user_id' => $me->id,
            'message' => $message,
        ]);

        return redirect('/conversations/' . $conversation->id);
    }

    public function showConversation(Conversation $conversation){ 
        //Laravel recibiendo un id puede convertirlo automaticamente a un objeto de eloquent, por eso el parametro definido es de tipo Conversation a pesar que tanto en la ruta como en el redirect de send PrivateMessage lo que se está enviando es el $conversation->id

        $conversation->load('users', 'privateMessages');
        
        return view('users.conversation', [
            'conversation' => $conversation,
            'user' => auth()->user(),
        ]);
    }

    private function findByUsername($username){
        return User::where('username', $username)->first();
    }

}
