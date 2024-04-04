<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{

    public function saveFile($request)
    {
        $id = uniqid(date('HisYmd'));
        $name_audio = $request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->getClientOriginalExtension();


        $fileName = "{$id}.{$extension}";

        try {
            $request->file('file')->storeAs('public/audios', $fileName);

            $link = "http://localhost/storage/audios/$fileName";

            return [
                'success' => true,
                'url'     => $link
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    public function sendFile($fileName)
    {
        try {
            $filePath = storage_path("/public/audios/" . $fileName . '.mp3');
            $file = Storage::get("/public/audios/" . $fileName . '.mp3');
            $base64File = base64_encode($file);

            return [
                'success' => true,
                'file_name' => $fileName,
                'base64_file' => $base64File
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
