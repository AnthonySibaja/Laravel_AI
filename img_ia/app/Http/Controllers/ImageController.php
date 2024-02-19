<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{
    public function showGenerateForm()
    {
        return view('upload');
    }

    public function generate(Request $request)
    {
        $text = $request->input('text');

        $response = Http::post('https://api.midjourney.com/generate', [
            'text' => $text,
        ]);

        $data = $response->json();
        $url = $data['upscaled_photo_url'];

        return view('result', compact('url'));
    }
}