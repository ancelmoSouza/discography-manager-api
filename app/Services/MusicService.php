<?php

namespace App\Services;

use App\Repositories\MusicRepository;
use Illuminate\Http\Request;

class MusicService
{
    protected $musicRepository;

    public function __construct(MusicRepository $musicRepository)
    {
        $this->musicRepository = $musicRepository;
    }

    public function register(Request $request)
    {
        $atributtes = $request->all();
        $error = $this->musicRepository->save($atributtes);

        if ($error['error']) {
            return response()->json($error, 500);
        } else {
            return response()->json($error, 200);
        }
    }

    public function getAll()
    {
        $error = $this->musicRepository->getAll();
        if ($error['error']) {
            return response()->json($error, 500);
        } else {
            return response()->json($error, 200);
        }
    }

    public function getByName(Request $request)
    {
        $error = $this->musicRepository->getByName($request->name);
        if ($error['error']) {
            return response()->json($error, 500);
        } else {
            return response()->json($error, 200);
        }
    }

    public function destroy($id)
    {
        $error = $this->musicRepository->delete($id);
        if ($error['error']) {
            return response()->json($error, 500);
        } else {
            return response()->json($error, 200);
        }
    }
}
