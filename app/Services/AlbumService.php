<?php

namespace App\Services;

use App\Repositories\AlbumRepository;
use Illuminate\Http\Request;

class AlbumService
{
    protected $albumRepository;

    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }

    public function register(Request $request)
    {
        $atributtes = $request->all();

        $response = $this->albumRepository->save($atributtes);

        if ($response['success']) {
            return response()->json($response, 200);
        } else {
            return response()->json($response, 500);
        }
    }
    public function getAll()
    {
        $response = $this->albumRepository->getAll();

        if ($response['success']) {
            return response()->json($response, 200);
        } else {
            return response()->json($response, 500);
        }
    }

    public function getByTitle(Request $request)
    {
        $response = $this->albumRepository->getByTitle($request['']);

        if ($response['success']) {
            return response()->json($response, 200);
        } else {
            return response()->json($response, 500);
        }
    }

    public function destroy($albumId)
    {
        $response = $this->albumRepository->delete($albumId);

        if ($response['success']) {
            return response()->json($response, 200);
        } else {
            return response()->json($response, 500);
        }
    }

    public function getFullAlbum($id)
    {
        $response = $this->albumRepository->getFullAlbum($id);

        if ($response['success']) {
            return response()->json($response, 200);
        } else {
            return response()->json($response, 500);
        }
    }
}
