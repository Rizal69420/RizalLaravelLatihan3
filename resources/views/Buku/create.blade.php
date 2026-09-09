@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <div class="container">
        <h1>Tambah Buku</h1>
        <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" id="isbn" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="foto_buku">Foto Buku</label>
                <input type="file" name="foto_buku" id="foto_buku" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="nama_buku">Nama Buku</label>
                <input type="text" name="nama_buku" id="nama_buku" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-control" required>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection