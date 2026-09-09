<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('foto_buku');
            $table->string('nama_buku');
            $table->unsignedInteger('stok');
            $table->timestamps();

            $table->foreignId('kategori_id')
                  ->nullable()  
                  ->constrained('kategori')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
