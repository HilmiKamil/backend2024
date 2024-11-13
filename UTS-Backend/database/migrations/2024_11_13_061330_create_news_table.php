<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Kelas migrasi untuk membuat tabel 'news'
return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel 'news'.
     */
    public function up(): void
    {
        // Membuat tabel 'news' dengan kolom yang diperlukan
        Schema::create('news', function (Blueprint $table) {
            $table->id(); // Kolom ID yang otomatis bertambah
            $table->string('title'); // Kolom untuk judul berita
            $table->string('author'); // Kolom untuk nama penulis berita
            $table->string('description'); // Kolom untuk deskripsi singkat berita
            $table->text('content'); // Kolom untuk konten berita (isi lengkap)
            $table->string('url'); // Kolom untuk URL berita
            $table->string('url_image'); // Kolom untuk URL gambar berita
            $table->datetime('published_at'); // Kolom untuk waktu publikasi berita
            $table->string('category'); // Kolom untuk kategori berita
            $table->timestamps(); // Kolom untuk waktu dibuat dan diperbarui (created_at, updated_at)
        });
    }

    /**
     * Membalikkan migrasi dengan menghapus tabel 'news'.
     */
    public function down(): void
    {
        Schema::dropIfExists('news'); // Menghapus tabel 'news' jika ada
    }
};
