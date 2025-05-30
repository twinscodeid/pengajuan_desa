<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{

    public function showPrivateImage($filename): StreamedResponse
    {
        $path = 'surat_pengantar_rt_rw/' . $filename;

        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return Storage::disk('local')->response($path); // Bisa diganti ->download($path)
    }
}
