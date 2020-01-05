<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class VotesController extends Controller
{
    /**
     * Apply an up-vote to a post specified by a given ID
     */
    public function upVote($id)
    {
        // If there is no one logged in, ignore this request
        if(!(request()->user())) {
            return redirect('/register');
        }

        $post = Post::where('id', $id)->firstOrFail();
        $user = request()->user();

        $upVote = $user->upVotes->contains($post);
        $downVote = $user->downVotes->contains($post);

        if ($downVote) {
            $user->downVotes()->detach($post);
        }

        if($upVote) {
            $user->upVotes()->detach($post);
        } else {
            $user->upVotes()->attach($post);
        }

        return redirect()->back();
    }

    /**
     * Apply a down-vote to a post specified by a given ID
     */
    public function downVote($id)
    {
        // If there is no one logged in, ignore this request
        if(!(request()->user())) {
            return redirect('/register');
        }

        $post = Post::where('id', $id)->firstOrFail();
        $user = request()->user();

        $upVote = $user->upVotes->contains($post);
        $downVote = $user->downVotes->contains($post);

        if ($upVote) {
            $user->upVotes()->detach($post);
        }

        if($downVote) {
            $user->downVotes()->detach($post);
        } else {
            $user->downVotes()->attach($post);
        }

        return redirect()->back();
    }
}
