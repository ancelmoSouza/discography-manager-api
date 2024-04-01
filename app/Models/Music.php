<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    protected $table = "musics";
    protected $fillable = [
        'id',
        'name',
        'release_date',
        'auhtor_id',
    ];
}
