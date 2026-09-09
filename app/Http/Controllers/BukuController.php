<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $kategori = Kategori::all();
        return view('buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'isbn'          => 'required|string|max:255',
            'foto_buku'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_buku'     => 'required|string|max:255',
            'stok'          => 'required|integer',
            'kategori_id'   => 'required|exists:kategori,id',
        ]);

        if ($request->hasFile('foto_buku')) {
            $validated['foto_buku'] = $request->file('foto_buku')->store('buku', 'public');
        }

        Buku::create($validated);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'isbn'          => 'required|string|max:255',
            'foto_buku'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_buku'     => 'required|string|max:255',
            'stok'          => 'required|integer',
            'kategori_id'   => 'required|exists:kategori,id',
        ]);

        if ($request->hasFile('foto_buku')) {
            if ($buku->foto_buku) {
                Storage::disk('public')->delete($buku->foto_buku);
            }
            $validated['foto_buku'] = $request->file('foto_buku')->store('buku', 'public');
        } else {
            $validated['foto_buku'] = $buku->foto_buku;
        }
        $buku->update($validated);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);
        if ($buku->foto_buku) {
            Storage::disk('public')->delete($buku->foto_buku);
        }

        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
