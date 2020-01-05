<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

use Illuminate\Database\Seeder;

use App\User;
use Post;

class DownVotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user) {
            Post::inRandomOrder()
                ->limit(25)
                ->get()
                ->each(function($post) use ($user) {
                    $upVote = $user->upVotes->contains($post);

                    if (!$upVote) {
                        $user->downVotes()->attach($post);
                    }
            });
        });
    }
}
