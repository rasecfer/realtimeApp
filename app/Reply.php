<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //Esta función se ejecuta antes de crear el registro y la utilizamos para asignar el usuario logueado a la respuesta
    public static function boot(){
        parent::boot();
        static::creating(function($reply){
            $reply->user_id = auth()->id();
        });
    }

    protected $guarded = [];
    //Definición de la relaciones
    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function like(){
        return $this->hasMany(Like::class);
    }
}
