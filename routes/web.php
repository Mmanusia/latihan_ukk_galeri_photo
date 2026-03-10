<?php

use App\Http\Controllers\FotoController;
use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FotoController::class, 'index'])->name('index');
Route::redirect('/index', '/');
Route::redirect('/home', '/');
Route::get('/detail/{foto}', [FotoController::class, 'detail'])->name('foto.detail');

Route::middleware('auth')->group(function () {
    // Album
    Route::get('/tambahAlbum', [AlbumController::class, 'index'])->name('album.form');
    Route::post('/album', [AlbumController::class, 'tambah'])->name('album.tambah');    
    
    // Foto
    Route::get('/tambah', [FotoController::class, 'create'])->name('foto.form');
    Route::post('/foto', [FotoController::class, 'tambah'])->name('foto.tambah');
    Route::post('/foto/{foto}/komentar', [FotoController::class, 'tambahKomentar'])->name('foto.komen');
    Route::post('/foto/{foto}/like', [FotoController::class, 'tambahLike'])->name('foto.like');
    Route::delete('/foto/{foto}', [FotoController::class, 'destroy'])->name('foto.destroy');
});
