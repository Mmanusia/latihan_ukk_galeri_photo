<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Foto Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <header>
        <h1>Upload foto dan lihat galeri</h1>
        <a href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="btn btn-md btn-primary">LOGOUT</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>

        <p>bisa unggah foto</p>

        <p>{{ $fotos->count() }}</p>
        <p>Total Foto</p>
        <hr>
        <p>{{ $fotos->pluck('AlbumID')->unique()->count() }}</p>
        <p>Total Album</p>
    </header>

    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <p>Data upload belum valid:</p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <hr>
    <h2>Tambah Album</h2>
    <p>untuk mengunggah album, login dahulu!</p>
    <a class="btn btn-primary"  href="/tambahAlbum">Tambah Album Foto</a>

    <hr>
    <h2>Unggah Foto</h2>
    <p>untuk mengunggah foto, login dahulu!</p>
    <a class="btn btn-primary"  href="/tambah">Tambah Foto</a>
    
{{-- 
    <hr>
    <p>Pengunjung bisa melihat semua foto.</p>

    @if (Route::has('login'))
    <a href="{{ route('login') }}">Login</a>
    @endif --}}


    <hr>
    <h2>Galeri Foto</h2>
    <p>Semua foto terbaru tampil di bawah ini.</p>

    <div class="card text-center" style="width: 18rem;">
        @forelse ($fotos as $foto)
        <a href="{{ route('foto.detail', $foto) }}">
            <img src="{{ asset($foto->LokasiFile) }}" alt="{{ $foto->JudulFoto }}" width="150" height="100" class="card-img-top">
        </a>
        <div class="card-body">
            <h5 class="card-title">{{ $foto->JudulFoto }}</h5>
            <p class="card-text">{{ $foto->likes_count }} Like</p>
        </div>
    </div>
    <hr>

    @auth
    @if (auth()->user()->isAdmin())
    <form action="{{ route('foto.destroy', $foto) }}" method="POST"
        onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
        @csrf
        @method('DELETE')
        <button type="submit">
            Hapus Foto?
        </button>
    </form>
    @endif
    @endauth

    @empty
    <h3>Belum ada foto</h3>
    @endforelse
    </section>
    </div>
    </div>

</body>