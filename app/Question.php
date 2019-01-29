<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
    protected $table = 'questions';

    protected $fillable = [
        'title', 'slug', 'body', 'category_id', 'user_id'
    ];

    /**
     * Con esta función se le indica a Laravel cuál es el campo parámetro de búsqueda en la ruta
     * En este caso el campo será slug
     */
    public function getRouteKeyName(){
        return 'slug';
    }

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

    public function getPathAttribute(){
        return asset("api/question/$this->slug");
    }
}
