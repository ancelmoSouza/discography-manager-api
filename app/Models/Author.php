<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Author extends Model
{
    use HasFactory;

    protected $table = "authors";

    protected $fillable = [
        'name',
        'pseudonym',
    ];
}