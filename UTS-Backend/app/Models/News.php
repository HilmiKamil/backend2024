<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model untuk tabel 'news'
class News extends Model
{
    // Mengizinkan mass assignment untuk kolom-kolom berikut
    protected $fillable = [
        'title',        // Judul berita
        'author',       // Nama penulis berita
        'description',  // Deskripsi singkat berita
        'content',      // Konten lengkap berita
        'url',          // URL berita
        'url_image',    // URL gambar berita
        'published_at', // Waktu publikasi berita
        'category',     // Kategori berita
        'created_at',   // Waktu dibuat (otomatis diisi oleh Laravel)
        'updated_at',   // Waktu diperbarui (otomatis diisi oleh Laravel)
    ];
}
