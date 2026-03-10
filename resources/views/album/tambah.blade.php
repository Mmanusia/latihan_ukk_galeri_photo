<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <body>
        
        <hr>
        <div style="margin-right: 0%">
            <a class="btn btn-primary" href="{{ route('index') }}">Kembali ke galeri</a>
        </div>
        @auth
        <form action="{{ route('album.tambah') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <H1>Tambah Album</H1>

            <div class="mb-3">
                <hr>
                <label for="NamaAlbum" class="form-label">Nama Album</label>
                <input class="form-control" id="NamaAlbum" name="NamaAlbum" type="text" value="{{ old('NamaAlbum') }}" placeholder="Ini Album">
            </div>
            
            <div class="mb-3">
                <hr>
                <label for="Deskripsi" class="form-label">Deskripsi Album</label>
                <textarea class="form-control" style="height: 100px" id="Deskripsi" name="Deskripsi" rows="4" placeholder="Tambahkan keterangan singkat Album">{{ old('Deskripsi') }}</textarea>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary position-relative">
                Tambah Sekarang
            </button>
        </form>
        @else
        
        @endauth
    </body>
    </html>