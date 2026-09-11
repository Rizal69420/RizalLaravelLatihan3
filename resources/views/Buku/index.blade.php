@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <div class="container">
        <h1>Daftar Buku</h1>
        <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ISBN</th>
                    <th>Foto Buku</th>
                    <th>Nama Buku</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->isbn }}</td>
                        <td><img class="foto-buku" src="{{ asset('storage/' . $item->foto_buku) }}" alt="Foto Buku"></td>
                        <td>{{ $item->nama_buku }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>
                            @if ($item->kategori)
                                {{ $item->kategori->nama_kategori }}
                            @else
                                Kategori tidak tersedia
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('buku.destroy', $item->id) }}" method="POST" style="display: inline on" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection