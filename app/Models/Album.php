<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Album extends Model
{
    use HasFactory;

    protected $table = "albums";
    protected $fillable = [
        'id',
        'title',
        'release_date',
    ];
}
