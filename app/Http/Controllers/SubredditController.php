<?php
/**
 * @author Alex Madsen
 *
 * @date November 6, 2018
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Subreddit;

class SubredditController extends Controller
{
    public function index($handle)
    {
        $subreddit = Subreddit::where('handle', $handle)->firstOrFail();
        $posts = Post::where('subreddit_id', $subreddit->id)->orderBy('created_at', 'desc')->limit(25)->get();

        $viewData = [
            'subreddit' => $subreddit,
            'posts' => $posts,
        ];

        return view('subreddit', $viewData);
    }
}
