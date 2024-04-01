<?php

namespace App\Http\Controllers;

use App\Services\AlbumService;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    protected $albumService;

    public function __construct(AlbumService $albumService)
    {
        $this->albumService = $albumService;
    }


    public function register(Request $request)
    {
        return $this->albumService->register($request);
    }

    public function getAll()
    {
        return $this->albumService->getAll();
    }

    public function getByTitle(Request $request)
    {
        return $this->albumService->getByTitle($request);
    }

    public function delete($id)
    {
        return $this->albumService->destroy($id);
    }

    public function getFullAlbum($id)
    {
        return $this->albumService->getFullAlbum($id);
    }
}
