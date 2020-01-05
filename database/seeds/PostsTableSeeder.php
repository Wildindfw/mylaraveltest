<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

use Illuminate\Database\Seeder;

use App\User;
use App\Post;
use App\Subreddit;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function($user) {
            $postCount = mt_rand(5,25);
            factory(Post::class, $postCount)->make([
                'id_users' => $user->id,
            ])->each(function($post) {
                $post->subreddit_id = Subreddit::inRandomOrder()->first()->id;
                $post->save();
            });
        });
    }
}
