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

    public function addMusic($musicId, $albumId)
    {
        try {
            $response = $this->musicAlbumRepository->addMusic($musicId, $albumId);
            return $response;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
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
