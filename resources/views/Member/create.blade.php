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
                <br>
                <img id="preview" src="#" alt="Preview" style="display: none; width: 150px; margin-top: 10px;">
                <button type="button" id="cancelImage" style="display:none;">
                    Batal
                </button>
               <!-- @error('foto_member')<div class="text-danger">{{ $message}}</div>@enderror !-->
            </div>
            <div class="form-group">
                <label for="nama_member">Nama Member</label>
                <input type="text" name="nama_member" id="nama_member" class="form-control" value="{{ old('nama_member')}}" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Pria" {{ old('jenis_kelamin') == 'Pria' ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ old('jenis_kelamin') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                </select>
                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir')}}" required>
            </div>
            <div class="form-group">
                <label for="no_telepon">No. Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" class="form-control" value="{{ old('no_telepon')}}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email')}}" required>
            </div>
            <div class="form-group">
                <label for="buku_id">Buku</label>
                <select name="buku_id" id="buku_id" class="form-control" value="{{ old('buku_id')}}" required>
                    @foreach ($buku as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_buku }} - Stok {{ $item->stok}}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('member.index') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
<script>
const input = document.getElementById('foto_member');
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