@extends('layouts.app')

@section('title', 'Tambah Member')

@section('content')
    <div class="container">
        <h1>Tambah Member</h1>
        <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
            <div class="form-group">
                <label for="foto_member">Foto Member</label>
                <input type="file" name="foto_member" id="foto_member" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="nama_member">Nama Member</label>
                <input type="text" name="nama_member" id="nama_member" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="stok">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Pria" {{ old('jenis_kelamin') == 'Pria' ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ old('jenis_kelamin') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                </select>
                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="no_telepon">No. Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="buku_id">Buku</label>
                <select name="buku_id" id="buku_id" class="form-control" required>
                    @foreach ($buku as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_buku }}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('member.index') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection