<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService400
{
    public static function upload($imageFile, $folderName)
    {
        //dd($imageFile['image']);
        if (is_array($imageFile)) {
            $file = $imageFile['image'];
        } else {
            $file = $imageFile;
        }

        $fileName = uniqid(rand() . '_');
        $extension = $file->extension();
        $fileNameToStore = $fileName . '.' . $extension;
        $resizedimage = InterventionImage::make($file)->resize(400, 400)->encode();
        Storage::put(
            'public/' . $folderName . '/' . $fileNameToStore,
            $resizedimage
        );

        return $fileNameToStore;
    }
}
