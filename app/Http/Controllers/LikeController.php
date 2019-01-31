<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use App\Reply;

class LikeController extends Controller
{
    public function likeIt(Reply $reply){
        $reply->like()->create([
            // 'user_id' => auth()->id()
            'user_id' => 1
        ]);
    }

    public function unLikeIt(Reply $reply){
        $reply->like()->where([
            // 'user_id' => auth()->id()
            'user_id' => 1
        ])->first()->delete();
    }
}
