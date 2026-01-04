<?php

namespace App\Http\Controllers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends Controller
{
    public function download(Media $media): BinaryFileResponse
    {
        // здесь позже можно добавить проверку ролей / принадлежности тикету

        return response()->download(
            $media->getPath(),
            $media->file_name
        );
    }
}
