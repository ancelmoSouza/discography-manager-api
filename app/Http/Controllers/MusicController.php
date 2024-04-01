<?php

namespace App\Http\Controllers;

use App\Services\MusicService;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    protected $musicService;

    public function __construct(MusicService $musicService)
    {
        $this->musicService = $musicService;
    }


    public function register(Request $request)
    {
        return $this->musicService->register($request);
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
}
