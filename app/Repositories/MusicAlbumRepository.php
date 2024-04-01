<?php

namespace App\Repositories;

use App\Models\MusicAlbum;
use Illuminate\Support\Facades\DB;

class MusicAlbumRepository
{
    protected $musicAlbum;

    public function __construct(MusicAlbum $musicAlbum)
    {
        $this->musicAlbum = $musicAlbum;
    }
    public function delete($albumId, $musicId)
    {
        try {
            DB::beginTransaction();

            $musicOfAlbum = $this->musicAlbum->where([
                'music_id' => $musicId,
                'album_id' => $albumId
            ])->first();

            if (!$musicOfAlbum) {
                return [
                    'success' => false,
                    'message' => 'Error: Não foi posível realizar a exclusão. Registro não encontrado',
                ];
            }

            $musicOfAlbum->delete();

            DB::commit();

            return [
                'success' => true,
                'message' => 'Musica removida com sucesso do album!'

            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
