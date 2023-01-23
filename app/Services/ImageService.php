<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * @param UploadFile
     * @return Array
     */
    public function base64Encode(UploadedFile $file): array
    {
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $base64String = base64_encode(file_get_contents($file->path()));
        $url = 'data:image/' . $ext . ';base64,' . $base64String;
        $id = uniqid();
        return compact('ext', 'url', 'id', 'name');
    }

    public function base64Decode(array $base64EncodeImages)
    {
        $images = [];
        foreach ($base64EncodeImages as $image) {
            $path = 'upload' . '/' . 'images';
            $url = $path . '/' . uniqid() . '.' . $image['ext'];
            $file = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image['url']));
            Storage::put($url, $file);
            $images[] = new Image([
                'url' => $url,
            ]);
        }

        return $images;
    }
}
