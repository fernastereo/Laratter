<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function users(){
    	return $this->belongsToMany(User::class);
    }

    public function privateMessages(){
    	return $this->hasMany(PrivateMessage::class)->orderBy('created_at', 'desc');
    }

    public static function between(User $user, User $other){
    	//Busco la conversation:
    	$query = Conversation::whereHas('users', function($query) use ($user){
    		$query->where('user_id', $user->id);
    	})->whereHas('users', function($query) use ($other){
    		$query->where('user_id', $other->id);
    	});

    	//Si no existe la creo:
    	$conversation = $query->firstOrCreate([]);

    	//Garantizo que estos dos usuarios estén en la conversation porque si la creé va a crearse vacía:
    	$conversation->users()->sync([
    		$user->id, $other->id
    	]);

    	return $conversation;
    }
}
