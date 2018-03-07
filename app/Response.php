<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guarded = [];

    public function message(){
    	return $this->belongsTo(Message::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
