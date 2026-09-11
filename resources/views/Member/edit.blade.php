@extends('layouts.app')

@section('title', 'Edit Member')

@section('content')
    <div class="container">
        <h1>Edit Member</h1>
        <form action="{{ route('member.update', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="foto_member">Foto Member</label>
                <input type="file" name="foto_member" id="foto_member" class="form-control-file">
                @if ($member->foto_member)
                    <img src="{{ asset('storage/' . $member->foto_member) }}" alt="{{ $member->nama_member }}" width="100">
                @endif
            </div>
            <div class="form-group">
                <label for="nama_member">Nama Member</label>
                <input type="text" name="nama_member" id="nama_member" class="form-control" value="{{ $member->nama_member }}" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Pria" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'Pria' ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>
            <div class="form-group">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $member->tanggal_lahir) }}">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
            </div>
            <div class ="form-group">
                <label for="no_telepon" class="form-label">No. Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" class="form-control" value="{{ $member->no_telepon }}" required>
            </div>
            <div class ="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $member->email }}" required>
            </div>
            <div class="form-group">
                <label for="buku_id">Buku</label>
                <select name="buku_id" id="buku_id" class="form-control" required>
                    @foreach ($buku as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $member->buku_id ? 'selected' : '' }}>{{ $item->nama_buku }} - Stok {{ $item->stok}}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('member.index') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection