<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageServices
{
    public function handleUploadedImage($image)
    {
        $storageFile = Storage::put(config('app.storage_images'), $image);
        Storage::delete(config('app.storage_images') . auth()->user()->image);
        return basename($storageFile);
    }
}
