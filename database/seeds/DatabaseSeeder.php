<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Question;
use App\Reply;
use App\Like;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 10)->create();
        factory(Category::class, 5)->create();
        factory(Question::class, 30)->create();
        factory(Reply::class, 100)->create()->each(function ($reply){
            return $reply->like()->save(factory(Like::class)->make());
        });
    }
}
