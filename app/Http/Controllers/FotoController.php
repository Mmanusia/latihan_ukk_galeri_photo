<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use App\Models\KomentarFoto;
use App\Models\LikeFoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FotoController extends Controller
{
    public function create(): View
    {
        $albums = Album::query()->latest('id')->get();

        return view('foto.tambah', compact('albums'));
    }

    public function index(): View
    {
        $fotos = Foto::with([
                'user',
                'album',
                'komentars.user',
            ])
            ->withCount(['likes', 'komentars'])
            ->latest('TanggalUnggah')
            ->get();

        $likedFotoIds = [];

        if (auth()->check()) {
            $likedFotoIds = LikeFoto::query()
                ->where('UserID', auth()->id())
                ->pluck('FotoID')
                ->all();
        }

        return view('index', [
            'fotos' => $fotos,
            'likedFotoIds' => $likedFotoIds,
        ]);
    }

    public function tambah(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'JudulFoto' => ['required', 'string', 'max:255'],
        'DeskripsiFoto' => ['nullable', 'string'],
        'AlbumID' => ['required', 'exists:album,id'],
        'file_foto' => ['required', 'image', 'max:5120'],
    ]);

    $file = $request->file('file_foto');
    $uploadDirectory = public_path('uploads/foto');

    if (!File::exists($uploadDirectory)) {
        File::makeDirectory($uploadDirectory, 0755, true);
    }

    $fileName = now()->format('YmdHis') . '_' . Str::random(12) . '.' . $file->getClientOriginalExtension();
    $file->move($uploadDirectory, $fileName);

    Foto::create([
        'JudulFoto' => $validated['JudulFoto'],
        'DeskripsiFoto' => $validated['DeskripsiFoto'] ?? null,
        'TanggalUnggah' => now()->toDateString(),
        'LokasiFile' => 'uploads/foto/' . $fileName,
        'AlbumID' => $validated['AlbumID'],
        'UserID' => $request->user()->id,
    ]);

    return back()->with('success', 'Foto berhasil diunggah.');
}

    public function destroy(Request $request, Foto $foto): RedirectResponse
    {
        abort_unless($request->user()?->isAdmin(), 403, 'Hanya admin yang bisa menghapus foto.');

        $filePath = public_path($foto->LokasiFile);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus oleh admin.');
    }

    public function tambahKomentar(Request $request, Foto $foto): RedirectResponse
    {
        $validated = $request->validate([
            'IsiKomentar' => ['required', 'string', 'max:1000'],
        ], [
            'IsiKomentar.required' => 'Komentar tidak boleh kosong.',
        ]);

        KomentarFoto::create([
            'FotoID' => $foto->id,
            'UserID' => $request->user()->id,
            'IsiKomentar' => $validated['IsiKomentar'],
            'TanggalKomentar' => now()->toDateString(),
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function destroyKomentar(Request $request, Foto $foto): RedirectResponse
    {
        
    }

    public function tambahLike(Request $request, Foto $foto): RedirectResponse
    {
        $existingLike = LikeFoto::query()
            ->where('FotoID', $foto->id)
            ->where('UserID', $request->user()->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();

            return back()->with('success', 'Like dibatalkan.');
        }

        LikeFoto::create([
            'FotoID' => $foto->id,
            'UserID' => $request->user()->id,
            'TanggalLike' => now()->toDateString(),
        ]);

        return back()->with('success', 'Foto berhasil dilike.');
    }

    public function detail(Foto $foto)
    {
        $foto->load([
            'user',
            'album',
            'komentars.user',
        ])->loadCount([
            'likes',
            'komentars',
        ]);

        $likedFotoIds = [];

        if (auth()->check()) {
            $likedFotoIds = LikeFoto::query()
                ->where('UserID', auth()->id())
                ->pluck('FotoID')
                ->all();
        }

        return view('foto.detail', [
            'foto' => $foto,
            'likedFotoIds' => $likedFotoIds,
        ]);
    }
}