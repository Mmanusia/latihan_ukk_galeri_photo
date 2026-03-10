@extends('layouts.app')

@section('title', 'Tambah Album')

@section('content')
<div class="container py-4 py-md-9">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <h1 class="h4 mb-0">Tambah Album</h1>
            <a class="btn btn-outline-primary" href="{{ route('index') }}">Kembali ke galeri</a>
            @auth
            <div class="card-body p-4">
                <form action="{{ route('album.tambah') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="NamaAlbum" class="form-label">Nama Album</label>
                        <input class="form-control" id="NamaAlbum" name="NamaAlbum" type="text"
                            value="{{ old('NamaAlbum') }}" placeholder="Isi nama album">
                    </div>

                    <div class="mb-4">
                        <label for="Deskripsi" class="form-label">Deskripsi Album</label>
                        <textarea class="form-control" id="Deskripsi" name="Deskripsi" rows="4"
                            placeholder="Tambahkan keterangan singkat album">{{ old('Deskripsi') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Sekarang</button>
                </form>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection