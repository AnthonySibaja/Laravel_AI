<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class AudioTranslationController extends Controller
{
    public function upload()
    {
        return view('audio-translation.upload');
    }

    public function process(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:mp3,wav,ogg',
        ]);
        
        $filePath = $request->file('file')->getRealPath();
        Log::info('Ruta del archivo:', ['path' => $filePath]);
        
        $openaiApiKey = env('OPENAI_API_KEY');
        $apiUrl = 'https://api.openai.com/v1/audio/transcriptions';
        
        $client = new Client();
        $response = $client->post($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $openaiApiKey,
            ],
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($filePath, 'r'),
                ],
                [
                    'name' => 'timestamp_granularities[]',
                    'contents' => 'word',
                ],
                [
                    'name' => 'model',
                    'contents' => 'whisper-1',
                ],
                [
                    'name' => 'response_format',
                    'contents' => 'verbose_json',
                ],
            ],
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() === 200) {
            $transcription = $responseBody['text'];
            return view('audio-translation.result', ['transcription' => $transcription]);
        } else {
            Log::error('Error al realizar la transcripción de audio:', ['respuesta' => $response->getBody()->getContents()]);
            return back()->with('error', 'Error al realizar la transcripción de audio.');
        }
    }
}
