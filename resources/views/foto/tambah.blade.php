@extends('layouts.app')

@section('title', 'Tambah Foto')

@section('content')
<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <h1>Tambah Foto</h1>
        <a class="btn btn-outline-primary" href="{{ route('index') }}">Kembali ke galeri</a>
    </div>

    @auth
    <div class="card-body p-3">
        <form action="{{ route('foto.tambah') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="JudulFoto" class="form-label">Judul Foto</label>
                <input id="JudulFoto" name="JudulFoto" type="text" class="form-control" value="{{ old('JudulFoto') }}"
                    placeholder="Masukan judul foto">
            </div>

            <div class="mb-3">
                <label for="NamaAlbum" class="form-label">Album</label>
                <select id="NamaAlbum" name="AlbumID" class="form-select" required>
                    <option value="" disabled {{ old('AlbumID') ? '' : 'selected' }}>Pilih album</option>
                    @forelse ($albums as $album)
                    <option value="{{ $album->id }}" {{ old('AlbumID') == $album->id ? 'selected' : '' }}>
                        {{ $album->NamaAlbum }}
                    </option>
                    @empty
                    <option value="" disabled selected>Belum ada album, silakan tambah album dulu.</option>
                    @endforelse
                </select>
            </div>

            <div class="mb-3">
                <label for="DeskripsiFoto" class="form-label">Deskripsi</label>
                <textarea id="DeskripsiFoto" name="DeskripsiFoto" rows="4" class="form-control"
                    placeholder="Tambahkan keterangan singkat foto">{{ old('DeskripsiFoto') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="file_foto" class="form-label">File Foto</label>
                <input id="file_foto" name="file_foto" type="file" class="form-control" accept="image/*">
                <div class="form-text">Format gambar umum didukung, maksimal 5 MB.</div>
            </div>

            <button type="submit" class="btn btn-success">Upload Sekarang</button>
        </form>
    </div>

    @endauth
</div>
</div>
@endsection