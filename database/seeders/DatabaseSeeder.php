<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       \App\Models\User::factory()->count(50000)->has(\App\Models\Post::factory()->count(2), 'posts')->create();

             $user=DB::table('users')->inRandomOrder()->limit(20000)->get();

             foreach ($user as $key => $value) {
                
                 \App\Models\Comment::factory()->create([
                     'user_id'=>$value->id,
                     'post_id'=>rand(1,10000),
                 ]);
 
                 \App\Models\View::factory()->create([
                    'user_id'=>$value->id,
                    'post_id'=>rand(1,20000),
                 ]);
             }

       
    }
}
