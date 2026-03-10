<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function index(): View
    {
        $albums = Album::all();
        return view('album.tambah', compact('albums'));
    }

    public function tambah(Request $request)
    {
        $validate = $request->validate([
            'NamaAlbum' => 'required',
            'Deskripsi' => 'required',
            ]);
            $validate['TanggalDibuat'] = now()->toDateString();
            $validate['UserID'] = $request->user()->id;

        Album::create($validate);
        return redirect()->route('index')->with('sukses', 'Album Berhasil Ditambah.');
    }
}