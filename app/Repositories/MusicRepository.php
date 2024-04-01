<?php

namespace App\Repositories;

use App\Models\Music;
use App\Models\MusicAlbum;
use Illuminate\Support\Facades\DB;

class MusicRepository
{
    protected $music;

    public function __construct(Music $music)
    {
        $this->music = $music;
    }

    public function save(array $atributtes)
    {
        try {
            DB::beginTransaction();
            $this->music->insert($atributtes);
            DB::commit();

            return [
                'error' => false,
                'message' => 'Musica registrada com sucesso.',

            ];
        } catch (\Exception $e) {
            return  [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getAll()
    {
        try {
            $allMusics = $this->music->all();

            return [
                'error' => false,
                'data' => $allMusics
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getByName($name)
    {
        try {
            $music = $this->music->whereRaw(
                'LOWER(name) LIKE ?',
                ['%' . strtolower($name) . '%']
            )->get();

            return [
                'error' => false,
                'data' => $music,
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public function delete($musicId)
    {
        try {
            DB::beginTransaction();

            $this->music->destroy($musicId);

            DB::commit();

            return [
                'error' => false,
                'message' => 'Musica removida com sucesso'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
