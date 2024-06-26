<?php

namespace App\Services;

use App\Models\MusicAlbum;
use App\Repositories\MusicAlbumRepository;
use Illuminate\Support\Facades\DB;

class MusicAlbumService
{
    protected $musicAlbumRepository;

    public function __construct(MusicAlbumRepository $musicAlbumRepository)
    {
        $this->musicAlbumRepository = $musicAlbumRepository;
    }

    public function delete($albumId, $musicId)
    {
        $response = $this->musicAlbumRepository->delete($albumId, $musicId);

        if ($response['success']) {
            return response()->json($response, 200);
        } else {
            return response()->json($response, 500);
        }
    }
}
