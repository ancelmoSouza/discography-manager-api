<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Services\FileService;
use App\Services\MusicService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MusicController extends Controller
{
    protected $musicService;
    protected $fileService;

    public function __construct(MusicService $musicService, FileService $fileService)
    {
        $this->musicService = $musicService;
        $this->fileService = $fileService;
    }


    public function register(Request $request)
    {
        try {
            $music = new Music();


            // dd(json_decode($request->data, true));

            $validator = $music->validate(json_decode($request->data, true));

            if (!$request->hasFile('file')) {
                return response()->json([
                    'success' => false,
                    "message" => "Erro: Nenhum arquivo de audio foi adicionado para upload."
                ], 422);
            }

            if ($validator->fails()) {
                return response()->json($validator->errors(), 500);
            }

            $response = $this->musicService->register(json_decode($request->data, true), $request);

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAll()
    {
        return $this->musicService->getAll();
    }
    public function getByName(Request $request)
    {
        return $this->musicService->getByName($request);
    }

    public function delete($id)
    {
        return $this->musicService->destroy($id);
    }

    public function storageFile(Request $request)
    {
        $response = $this->fileService->saveFile($request);

        return response()->json([
            'success' => true,
            'url' => $response,
            "message" => 'Upload da musica feito com sucesso'
        ]);
    }

    public function sendFile($uuid_file)
    {
        //19401920240402660c5f230f870

        $response = $this->fileService->sendFile($uuid_file);

        if ($response['success']) {
            return response()->json($response, 200);
        } else {
            return response()->json($response, 500);
        }
    }
}
