<?php

namespace App\Repositories;

use App\Models\Album;
use App\Models\MusicAlbum;
use Illuminate\Support\Facades\DB;

class AlbumRepository
{
    protected $album;
    protected $musicAlbum;

    public function __construct(Album $album, MusicAlbum $musicAlbum)
    {
        $this->album = $album;
        $this->musicAlbum = $musicAlbum;
    }


    public function save(array $atributtes)
    {
        try {
            DB::beginTransaction();
            $this->album->insert($atributtes);
            DB::commit();

            return [
                "success" => true,
                "message" => "Album cadastrado com sucessso!"
            ];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "message" => $e->getMessage(),
            ];
        }
    }
    public function getAll()
    {
        try {
            $allAlbums = $this->album->all();

            return [
                'success' => true,
                'data' => $allAlbums
            ];
        } catch (\Exception $e) {
            return [
                'success' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getByTitle($title): array
    {
        try {
            $music = $this->album->whereRaw(
                'LOWER(title) LIKE ?',
                ['%' . strtolower($title) . '%']
            )->get();

            return [
                'success' => true,
                'data' => $music,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function delete($albumId): array
    {
        try {
            DB::beginTransaction();

            $response = $this->album->destroy($albumId);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Album removido com sucesso',
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getFullAlbum($id): array
    {
        try {
            $album = $this->album->where('id', $id)->first();
            $listMusic = $this->musicAlbum->select([
                'm.name as name',
                'music_albums.music_id',
                'music_albums.album_id',
                'm.release_date',
            ])
                ->join('musics as m', 'music_albums.music_id', '=', 'm.id')
                ->get();

            return [
                'success' => true,
                'data' => [
                    'album_title' => $album->title,
                    'songs'       => $listMusic
                ]
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
