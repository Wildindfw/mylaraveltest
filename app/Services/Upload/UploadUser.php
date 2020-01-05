<?php

namespace App\Services\Upload;

use Illuminate\Support\Facades\Storage;

class UploadUser extends Upload
{

    function __construct()
    {
        $this->publicPath =
            'public'
            . DIRECTORY_SEPARATOR . 'upload'
            . DIRECTORY_SEPARATOR . 'user';

        $this->url = Storage::url('upload/user');
    }
}
