<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $member = Member::all();
        return view('member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $member = Member::all();
        $buku = Buku::where('stok', '>', 0)->get();
        return view('member.create', compact('member', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'foto_member'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_member'   => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'required|date',
            'no_telepon'    => 'required|string',
            'email'         => 'required|email',
            'buku_id'       => 'required|exists:buku,id',
        ]);

        $buku = Buku::findOrFail($validated['buku_id']);
        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis');
        }

        if ($request->hasFile('foto_member')) {
            $validated['foto_member'] = $request->file('foto_member')->store('member', 'public');
        }
        
        Member::create($validated);
        $buku->decrement('stok');

        return redirect()->route('member.index')->with('success', 'Data Member berhasil disimpan!');
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
        $member = Member::findOrFail($id);
        $buku = Buku::where('stok', '>', 0)
        ->orWhere('id', $member->buku_id)
        ->get();

        return view('member.edit', compact('member', 'buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $member = Member::findOrFail($id);
        $oldBukuId = $member->buku_id;

        $validated = $request->validate([
            'foto_member'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_member'   => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'required|date',
            'no_telepon'    => 'required|string',
            'email'         => 'required|email',
            'buku_id'       => ['nullable', 
                                'exists:buku,id'],
        ]);

        $newBukuId = $validated['buku_id'];
        if ($newBukuId && $newBukuId != $oldBukuId) {
            $newBuku = Buku::findOrFail($newBukuId);
            if ($newBuku->stok <= 0) {
                return back()->with('error', 'stok buku habis');
            }
        }

        if ($oldBukuId && $oldBukuId != $validated['buku_id']) {
            Buku::find($oldBukuId)->increment('stok');
        }
        if ($validated['buku_id'] && $validated['buku_id'] != $oldBukuId) {
            Buku::find($validated['buku_id'])->decrement('stok');
        }

        if ($request->hasFile('foto_member')) {
            if ($member->foto_member) {
                Storage::disk('public')->delete($member->foto_member);
            }
            $validated['foto_member'] = $request->file('foto_member')->store('member', 'public');
        } else {
            unset($validated['foto_member']);
        }

        $member->update($validated);
        return redirect()->route('member.index')->with('success', 'Data member berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $member = Member::findOrFail($id);
        if ($member->foto_member) {
            Storage::disk('public')->delete($member->foto_member);
        }

        if ($member->buku_id) {
            Buku::find($member->buku_id)->increment('stok');
        }

        $member->delete();
        return redirect()->route('member.index')->with('success', 'Data member berhasil dihapus!');
    }
}
