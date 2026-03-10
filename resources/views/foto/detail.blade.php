@extends('layouts.app')

@section('title', 'Detail Foto')

@section('content')
<div class="container py-4 py-md-5">
    <h1>Detail Foto</h1>
    <a href="{{ route('index') }}" class="btn btn-outline-primary">Kembali ke galeri</a>

    @if (session('success'))
    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <p class="fw-semibold mb-2">Terjadi kesalahan:</p>
    <ul class="mb-0 ps-3">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <img src="{{ asset($foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}" class="card-img-top"
                style="max-height: 520px; object-fit: cover;">
            <div class="card-body">
                <h2 class="h4 mb-3">{{ $foto->JudulFoto }}</h2>
                <p class="mb-2">Album: {{ $foto->album?->NamaAlbum ?? 'Tanpa Album' }}</p>
                <p class="mb-2">Upload: {{ optional($foto->TanggalUnggah)->format('d M Y') ?? '-' }}</p>
                <p class="mb-3">Oleh: {{ $foto->user?->username ?? 'User' }}</p>
                <p class="mb-3">{{ $foto->DeskripsiFoto ?: 'Foto ini belum memiliki deskripsi.' }}
                </p>
                <span>{{ $foto->likes_count }} like</span>
                <span>{{ $foto->komentars_count }} komentar</span>

                @auth
                <div class="d-flex gap-2 flex-wrap">
                    <form action="{{ route('foto.like', $foto) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary"
                            type="submit">{{ in_array($foto->id, $likedFotoIds, true) ? 'Batal Like' : 'Like Foto' }}</button>
                    </form>

                    @if (auth()->user()->isAdmin())
                    <form action="{{ route('foto.destroy', $foto) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">Hapus Foto</button>
                    </form>
                    @endif
                </div>
                @endauth
            </div>
        </div>

        <div class="col-lg-5">
            <h3 class="h5 mb-3">Komentar</h3>

            @forelse ($foto->komentars as $komentar)
            <div class="border-bottom pb-3 mb-3">
                <p class="fw-semibold mb-1">{{ $komentar->user?->username ?? 'User' }}</p>
                <p class="small text-secondary mb-2">
                    {{ optional($komentar->TanggalKomentar)->format('d M Y') ?? '-' }}</p>
                <p class="mb-0">{{ $komentar->IsiKomentar }}</p>
            </div>
            @empty
            <p class="text-secondary mb-0">Belum ada komentar untuk foto ini.</p>
            @endforelse

            <h3 class="h5 mb-3">Tambah Komentar</h3>

            @auth
            <form action="{{ route('foto.komen', $foto) }}" method="POST">
                @csrf
                <textarea class="form-control mb-3" name="IsiKomentar" rows="4"
                    placeholder="Tulis komentar untuk foto ini..."></textarea>
                <button class="btn btn-success" type="submit">Kirim Komentar</button>
            </form>
            @else
            <p class="mb-0"><a class="btn btn-primary" href="/login">Login</a> dulu untuk memberi komentar dan
                like.</p>
            @endauth
        </div>
    </div>
</div>
@endsection