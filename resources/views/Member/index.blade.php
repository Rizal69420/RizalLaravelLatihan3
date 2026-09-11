@extends('layouts.app')

@section('title', 'Daftar Member')

@section('content')
    <div class="container">
        <h1>Daftar Member</h1>
        <a href="{{ route('member.create') }}" class="btn btn-primary mb-3">Tambah Member</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Foto Member</th>
                    <th>Nama Member</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($member as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('storage/' . $item->foto_member) }}" alt="{{ $item->nama_member }}" width="1000" aspect-ratio= 1;></td>
                        <td>{{ $item->nama_member }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->tanggal_lahir }}</td>
                        <td>{{ $item->no_telepon }}</td>
                        <td>{{ $item->email }}</td>
                        <td> @if ($item->buku) {{ $item->buku->nama_buku }} @else Tidak ada buku @endif </td>
                        <td class="actions">
                            <a href="{{ route('member.edit', $item->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('member.destroy', $item->id) }}" method="POST" style="display: inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus member ini?');">
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