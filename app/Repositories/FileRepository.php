<?php

namespace App\Repositories;

class FileRepository
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
                'success'   => true,
                'url'       => $link,
                'path'      => 'public/audios/' . $fileName,
                'file_name' => $fileName,
                'uuid'      => $id,
                'message'   => 'Upload do arquivo feito com sucesso'
            ];
        } catch (\Exception $e) {
            throw new \Exception('Error: ' . $e->getMessage());
        }
    }
}
