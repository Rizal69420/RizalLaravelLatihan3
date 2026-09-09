<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    //
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id');
    }
}
