<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    //
    protected $table = 'buku';

    protected $fillable = [
        'isbn',
        'foto_buku',
        'nama_buku',
        'stok',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function members()
    {
        return $this->hasMany(Member::class, 'buku_id');
    }
}
