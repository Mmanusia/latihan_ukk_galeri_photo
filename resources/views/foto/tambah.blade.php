    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+x6f068xJ3L820s3a" crossorigin="anonymous">
    
    <a href="{{ route('index') }}">Kembali ke galeri</a>
    @auth
    <form action="{{ route('foto.tambah') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <hr>
        <label for="JudulFoto">Judul Foto</label>
        <input id="JudulFoto" name="JudulFoto" type="text" value="{{ old('JudulFoto') }}"
            placeholder="Contoh: Plers Mabur">


        <hr>
        <label for="NamaAlbum">Album</label>
        <select id="NamaAlbum" name="AlbumID" required>
            <option value="" disabled {{ old('AlbumID') ? '' : 'selected' }}>Pilih album</option>
            @forelse ($albums as $album)
                <option value="{{ $album->id }}" {{ old('AlbumID') == $album->id ? 'selected' : '' }}>
                    {{ $album->NamaAlbum }}
                </option>
            @empty
                <option value="" disabled selected>Belum ada album, silakan tambah album dulu.</option>
            @endforelse
        </select>
        <hr>
        <label for="DeskripsiFoto">Deskripsi</label>
        <textarea id="DeskripsiFoto" name="DeskripsiFoto" rows="4"
            placeholder="Tambahkan keterangan singkat foto">{{ old('DeskripsiFoto') }}</textarea>


        <hr>
        <label for="file_foto">File Foto</label>
        <input id="file_foto" name="file_foto" type="file" accept="image/*">
        <p>Format gambar umum didukung, maksimal 5 MB.</p>


        <button type="submit">
            Upload Sekarang
        </button>
    </form>
    @else
    
    @endauth