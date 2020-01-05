<?php

namespace App\Services;

use App\Media;
use App\Post;
use App\Services\Upload\UploadMedia;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MediaServices
{
    private $uploadMedia;

    function __construct()
    {
        $this->uploadMedia = new UploadMedia();
    }

    public function upload(Request $request, Post $post)
    {
        $medias = [];
        $request = $request;

        DB::beginTransaction();
        $allFiles = $request->allFiles();
        foreach ($allFiles as $type => $files) {
            if ($type != 'photos' && $type != 'videos')
                continue;

            foreach ($files as $file) {
                $media = $this->uploadMedia->upload($request, $file);

                if (empty($media))
                    continue;

                $media = $post->medias()->create([
                    'id_users' => $post->id_users,
                    'type' => $type == 'photos' ? 'P' : 'V',
                    'file' => $media
                ]);
                $media->url_media =  $this->uploadMedia->getUrl($media->file);
                $medias[] = $media;
            }
        }

        DB::commit();
        return $medias;
    }

    public function delete(Post $post)
    {
        DB::beginTransaction();
        $post->medias()->each(function (Media $media) {
            $this->uploadMedia->delete($media->file);
            $media->delete();
        });

        $post->delete();
        DB::commit();
    }
}
