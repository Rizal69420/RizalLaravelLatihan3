@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <div class="container">
        <h1>Tambah Buku</h1>
        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn') }}" required>
                @error('isbn')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="foto_buku">Foto Buku</label>
                <input type="file" name="foto_buku" id="foto_buku" class="form-control-file" value="{{ old('foto_buku')}}">
                @error('foto_buku')<div class="text-danger">{{ $message}}</div>@enderror
                <br>
                <img id="preview" src="#" alt="Preview" style="display: none; width: 150px; margin-top: 10px;">
                <button type="button" id="cancelImage" style="display:none;">
                    Batal
                </button>
            </div>
            <div class="form-group">
                <label for="nama_buku">Nama Buku</label>
                <input type="text" name="nama_buku" id="nama_buku" class="form-control" value="{{ old('nama_buku')}}" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok')}}" required>
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-control" value="{{ old('kategori_id')}}" required>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('buku.index') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
<script>
const input = document.getElementById('foto_buku');
const preview = document.getElementById('preview');
const cancel = document.getElementById('cancelImage');

input.addEventListener('change', function() {
    const file = this.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
        cancel.style.display = 'inline-block';
    }
});

cancel.addEventListener('click', function() {
    input.value = '';
    preview.src = '#';
    preview.style.display = 'none';
    cancel.style.display = 'none';
});
</script>
@endsection