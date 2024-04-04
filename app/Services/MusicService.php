<?php

namespace App\Services;

use App\Repositories\FileRepository;
use App\Repositories\MusicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicService
{
    protected $musicRepository;
    protected $fileRepository;

    public function __construct(MusicRepository $musicRepository, FileRepository $fileRepository)
    {
        $this->musicRepository = $musicRepository;
        $this->fileRepository = $fileRepository;
    }

    public function register(array $atributtes, Request $request)
    {

        try {
            $fileSave = $this->fileRepository->saveFile($request);

            $response = $this->musicRepository->save([
                "name" => $atributtes['name'],
                "release_date" => $atributtes['release_date'],
                "author_id" => 1,
                "uuid_file" => $fileSave["uuid"],
            ]);


            return $response;
        } catch (\Exception $e) {
            Storage::delete($fileSave['path']);
            throw new \Exception($e->getMessage());
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
        $error = $this->musicRepository->getByName($request['name']);
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
