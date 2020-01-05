<?php

namespace App\Http\Controllers;

use App\Post;
use App\Services\MediaServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        if(!(request()->user())) {
            return redirect('/login');
        }
        $subreddit = Subreddit::where('handle', $handle)->firstOrFail();
        $viewData = [
            'subreddit' => $subreddit,
            return view('add-post', $viewData);
        ]
        $posts = Auth::user()
            ->posts()
            ->orderBy('id', 'desc')
            ->paginate();

        $posts->each(function ($post, $key) {
            $post->likes = $post->likes()->count();
            return $post;
        });

        return $posts;
    }

    public function update($handle)
    {
        if(!(request()->user())) {
            return redirect()->back();
         }

        request()->validate([
            'title' => 'required|max:255|min:10',
            'content'=>'required',
        ]);

        $formData = request()->all();

        $user = request()->user();
        $subreddit = Subreddit::where('handle', $handle)->firstOrFail();

        $post = new Post();
        $post->id_users = $user->id;
        $post->subreddit_id = $subreddit->id;
        $post->title = $formData['title'];
        $post->content = $formData['content'];
        $post->save();

        // Start out upvoting your own post
        $user->upVotes()->attach($post);

        return redirect("/r/{$handle}");
    }
    public function create(Request $request, MediaServices $mediaServices)
    {
        $erros = $this->validator($request);
        if (!empty($erros))
            return $erros;

        $data = $request->only('description');
        $post = Auth::user()
            ->posts()
            ->create($data);

        $post->medias = $mediaServices->upload($request, $post);

        return $post;
    }

    public function update(Request $request, $idPost)
    {
        $post = $this->checkDomain($idPost);

        if (empty($post))
            return response()->json(['message' => 'You don\'t have permission to update this Post'], 403);

        $erros = $this->validator($request, $post);
        if (!empty($erros))
            return $erros;

        $post->description = $request->description;
        $post->save();

        return $post;
    }

    public function delete(Request $request, MediaServices $mediaServices, $idPost)
    {
        $post = $this->checkDomain($idPost);

        if (empty($post))
            return response()->json(['message' => 'You don\'t have permission to update this Post'], 403);

        $mediaServices->delete($post);
        return response()->json([], 204);
    }

    private function checkDomain($idPost)
    {
        $post = Auth::user()
            ->posts()
            ->find($idPost);

        return $post;
    }

    private function validator(Request $request, Post $post = null): array
    {
        $rules = ['description' => 'required|string'];

        if (empty($post)) {
            $rules['photos'] = 'max:5';
            $rules['photos.*'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:1024';
            $rules['videos'] = 'max:5';
            $rules['videos.*'] = 'mimetypes:video/avi,video/mp4,video/mpeg,video/quicktime|max:10024';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return response()->json([
                'message' => 'Form is not valid',
                'erros' => $validator->errors()->all()
            ], 400);

            return [];
    }
}
