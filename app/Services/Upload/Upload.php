<?php

namespace App\Services\Upload;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use OutOfBoundsException;
use WideImage\WideImage;

class Upload
{
    protected $publicPath, $url;

    public function getPublicPath()
    {
        if (empty($this->publicPath))
            throw new UnexpectedValueException('publicPath not implemeted');

        return storage_path(
            'app' . DIRECTORY_SEPARATOR . $this->publicPath
        );
    }

    public function getFullPath(String $nameFile)
    {
        if (empty($this->publicPath))
            throw new UnexpectedValueException('publicPath not implemeted');

        return storage_path(
            'app'
                . DIRECTORY_SEPARATOR . $this->publicPath
                . DIRECTORY_SEPARATOR . $nameFile
        );
    }

    public function getUrl(String $file = '')
    {
        if (empty($this->url))
            throw new UnexpectedValueException('url not implemeted');

        return $this->url
            . (empty($file) ? '' : '/' . $file);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $file = 'photo'): String
    {
        if (empty($this->publicPath))
            throw new UnexpectedValueException('publicPath not implemeted');

        $this->makeDirectory();
        $nameFile = null;

        if (is_string($file) && $request->hasFile($file))
            $file = $request->file($file);

        if (gettype($file) != 'object')
            return '';

        if ($file->isValid()) {
            $name = uniqid(date('HisYmd'));

            $extension = $file->extension();

            $nameFile = "{$name}.{$extension}";

            $upload = $file->storeAs($this->publicPath, $nameFile);

            if ($upload)
                return $nameFile;
        }

        return '';
    }

    public function resize(String $nameFile, $width = 640, $height = 480)
    {
        $fullPath = $this->getFullPath($nameFile);
        WideImage::load($fullPath)
            ->resize($width, $height)
            ->saveToFile($fullPath, 72);
    }

    public function delete(String $nameFile): bool
    {
        $fullPath = $this->getFullPath($nameFile);

        if (file_exists($fullPath))
            return unlink($fullPath);

        return false;
    }

    private function makeDirectory()
    {
        if (!File::isDirectory(storage_path($this->publicPath))) {
            Storage::makeDirectory($this->publicPath);
        }
    }
}
