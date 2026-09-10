@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <div class="container">
        <h1>Edit Buku</h1>
        <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $buku->isbn) }}" required>
                @error('isbn')
                    <div class="text-danger">{{ $message }}</div>
                @enderror            
            </div>
            <div class="form-group">
                <label for="foto_buku">Foto Buku</label>
                <input type="file" name="foto_buku" id="foto_buku" class="form-control-file">
                @if ($buku->foto_buku)
                    <img src="{{ asset('storage/' . $buku->foto_buku) }}" alt="{{ $buku->nama_buku }}" width="100">
                @endif
            </div>
            <div class="form-group">
                <label for="nama_buku">Nama Buku</label>
                <input type="text" name="nama_buku" id="nama_buku" class="form-control" value="{{ $buku->nama_buku }}" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ $buku->stok }}" required>
            </div>
            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-control" required>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $buku->kategori_id ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection