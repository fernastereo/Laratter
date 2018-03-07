<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages(){
        return $this->hasMany(Message::class)->orderBy('created_at', 'desc');
    }

    public function follows(){
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'followed_id');
    }

    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'user_id');
    }

    public function isFollowing(User $user){
        //Se le está pidiendo a la Relación (follows) que diga si contiene el usuario que se envía como parámetro
        //es decir que diga si estoy siguiendo o no al usuario que mando como parámetro
        return $this->follows->contains($user);
    }

    public function responses(){
        return $this->hasMany(Response::class)->orderBy('created_at', 'desc');
    }

    public function socialProfiles(){
        return $this->hasMany(SocialProfile::class);
    }
}
