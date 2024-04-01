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
}
