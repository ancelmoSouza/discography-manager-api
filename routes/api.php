<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\MusicAlbumController;
use App\Http\Controllers\MusicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(MusicController::class)->group(function () {
    Route::post('/musics/store', 'register');
    Route::get('/musics/all', 'getAll');
    Route::get('/musics/getByName', 'getByName');
    Route::delete('/musics/{id}', 'delete');
    Route::post('/music/upload', 'storageFile');
    Route::get('/music/download/{uuid}', 'sendFile');
});

Route::controller(AlbumController::class)->group(function () {
    Route::post('/albums/store', 'register');
    Route::get('/albums/all', 'getAll');
    Route::get('/albums/getByTitle', 'getByTitle');
    Route::get('/albums/getFullAlbum/{id}', 'getFullAlbum');
    Route::delete('/albums/{id}', 'delete');
});

Route::controller(MusicAlbumController::class)->group(function () {
    Route::post('/musicAlbum/add', 'addMusic');
    Route::delete('/musicAlbum/{albumId}/{musicId}', 'delete');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
