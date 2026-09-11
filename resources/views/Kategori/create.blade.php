@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="container">
        <h1>Tambah Kategori</h1>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ old('nama_kategori')}}" required>
            </div>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection