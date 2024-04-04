<?php

namespace App\Http\Controllers;

use App\Services\MusicAlbumService;
use Illuminate\Http\Request;

class MusicAlbumController extends Controller
{
    protected $musicAlbumService;

    public function __construct(MusicAlbumService $musicAlbumService)
    {
        $this->musicAlbumService = $musicAlbumService;
    }

    public function delete($albumId, $musicId)
    {
        return $this->musicAlbumService->delete($albumId, $musicId);
    }

    public function addMusic(Request $request)
    {
        try {
            $response = $this->musicAlbumService->addMusic($request->musicId, $request->albumId);
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                "error"   => $e->getMessage(),
                "message" => "Não foi possível adicionar a musica ao album"
            ], 500);
        }
    }
}
