<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //Definición de las relaciones
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
