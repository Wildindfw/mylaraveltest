<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{

    public function post($idPost)
    {
        $post = Post::find($idPost);
        if (empty($post))
            return response()->json(['message' => 'Post not found'], 400);

        return $post->likes()->count();
    }

    public function user()
    {
        return Auth::user()->likes()->count();
    }

    public function save(Request $request, $idPost)
    {
        $post = Post::find($idPost);

        if (empty($post))
            return response()->json(['message' => 'Post not found'], 400);

        $user = Auth::user();

        $data = [
            'id_posts' => $post->id,
            'id_users' => $user->id
        ];

        $like = Like::where($data)->first();

        if (empty($like)) {
            return Like::create($data);
        } else {
            $like->delete();
            return ['success' => 1];
        }
    }
}
