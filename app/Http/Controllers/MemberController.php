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
        $buku = Buku::all();
        return view('member.create', compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'foto_member'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max=2048',
            'nama_member'   => 'required|string|max=255',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'required|date',
            'no_telepon'    => 'required|string',
            'email'         => 'required|email',
            'buku_id'       => 'nullable|exists:buku_id|unique:member,buku_id',
        ]);

        if ($request->hasFile('foto_member')) {
            $validated['foto_member'] = $request->file('foto_member')->store('member', 'public');
        }
        Member::create($validated);

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
        $buku = Buku::whereDoesntHave('member')
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
        $kopdes = Kopdes::findOrFail($id);

        $validated = $request->validate([
            'foto_member'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max=2048',
            'nama_member'   => 'required|string|max=255',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'required|date',
            'no_telepon'    => 'required|string',
            'email'         => 'required|email',
            'buku_id'       => ['nullable', 
                                'exists:buku,id', 
                                Rule::unique('member', 'buku_id')->ignore($kopdes->id)],
        ]);

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
        $member->delete();
        return redirect()->route('member.index')->with('success', 'Data member berhasil dihapus!');
    }
}
