<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <a href="{{ route('index') }}" class="btn btn-primary">Kembali ke galeri</a>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <p>Terjadi kesalahan:</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h1>{{ $foto->JudulFoto }}</h1>

    <img src="{{ asset($foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}" style="max-width: 500px; height" class="img-fluid align-middle">

    <hr>
    <p>Album: {{ $foto->album?->NamaAlbum ?? 'Tanpa Album' }}</p>
    <p>Upload: {{ optional($foto->TanggalUnggah)->format('d M Y') ?? '-' }}</p>
    <p>Oleh: {{ $foto->user?->username ?? 'User' }}</p>

    <hr>
    <p>Deskripsi: {{ $foto->DeskripsiFoto ?: 'Foto ini belum memiliki deskripsi.' }}</p>
    <p>{{ $foto->likes_count }} like</p>
    <p>{{ $foto->komentars_count }} komentar</p>

    @auth
        <form action="{{ route('foto.like', $foto) }}" method="POST">
            @csrf
            <button class="btn btn-primary" type="submit">{{ in_array($foto->id, $likedFotoIds, true) ? 'Batal Like' : 'Like Foto' }}</button>
        </form>

        @if (auth()->user()->isAdmin())
            <form action="{{ route('foto.destroy', $foto) }}" method="POST"
                onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Hapus Foto</button>
            </form>
        @endif
    @endauth

    <hr>
    <h2>Komentar</h2>

    @forelse ($foto->komentars as $komentar)
        <div>
            <p>{{ $komentar->user?->username ?? 'User' }}</p>
            <p>{{ optional($komentar->TanggalKomentar)->format('d M Y') ?? '-' }}</p>
            <p>{{ $komentar->IsiKomentar }}</p>
            <hr>
        </div>
    @empty
        <p>Belum ada komentar untuk foto ini.</p>
    @endforelse

    <h2>Tambah Komentar</h2>

    @auth
        <form action="{{ route('foto.komen', $foto) }}" method="POST">
            @csrf
            <textarea class="form-control" name="IsiKomentar" rows="4" placeholder="Tulis komentar untuk foto ini..."></textarea>
            <br>
            <button class="btn btn-success" type="submit">Kirim Komentar</button>
        </form>
    @else
        <p><a class="btn btn-primary" href="/login">Login</a> dulu untuk memberi komentar dan like.</p>
    @endauth
</body>

</html>