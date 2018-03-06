<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $guarded = [];    

	public function user(){
		return $this->belongsTo(User::class);
	}

	//Este método intercepta el llamado a una propiedad
	//Por eso es que en la vista no se invoca sino que se sigue llamando a la propiedad normalmente.
	public function getImageAttribute($image){
		if(!$image || starts_with($image, 'http')){
			return $image;
		}

		return \Storage::disk('public')->url($image);
	}
}
