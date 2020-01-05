<?php

namespace App\Services\Upload;

use Illuminate\Support\Facades\Storage;

class UploadMedia extends Upload
{

    function __construct()
    {
        $this->publicPath =
            'public'
            . DIRECTORY_SEPARATOR . 'upload'
            . DIRECTORY_SEPARATOR . 'media';

        $this->url = Storage::url('upload/media');
    }
}
