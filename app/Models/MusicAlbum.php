<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicAlbum extends Model
{
    use HasFactory;

    protected $table = "music_albums";

    protected $fillable = [
        'music_id',
        'album_id',
    ];
}
