<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

// Kontroler untuk mengelola sumber daya berita
class NewsController extends Controller
{
    /**
     * Menampilkan daftar semua berita.
     */
    public function index()
    {
        // Mengambil semua berita dari database
        $news = News::all();

        // Memeriksa apakah ada berita
        if ($news->isNotEmpty()) {
            $data = [
                'message' => 'Get All Resource',
                'data' => $news,
            ];
            return response()->json($data, 200); // Mengembalikan berita dalam format JSON
        } else {
            return response()->json([
                'message' => 'Data is Empty' // Mengembalikan pesan jika tidak ada berita
            ]);
        }
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        // Implementasi untuk form pembuatan berita (jika diperlukan)
    }

    /**
     * Menyimpan berita baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari permintaan
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required',
            'url' => 'required|url',
            'url_image' => 'required|url',
            'published_at' => 'required|date',
            'category' => 'required|string|max:100',
        ]);

        // Mengembalikan kesalahan validasi jika ada
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Membuat berita baru
        $news = News::create($request->all());

        // Memeriksa apakah berita berhasil ditambahkan
        if ($news) {
            $data = [
                'message' => 'Resource is Added Successfully',
                'data' => $news,
            ];
            return response()->json($data, 201); // Mengembalikan berita yang baru ditambahkan
        } else {
            $data = [
                'message' => 'Resource is Failed Updated'
            ];
        }

        return response()->json($data, 404); // Mengembalikan kesalahan jika gagal
    }

    /**
     * Menampilkan detail berita berdasarkan ID.
     */
    public function show(string $id)
    {
        // Mencari berita berdasarkan ID
        $news = News::find($id);

        // Memeriksa apakah berita ditemukan
        if ($news) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $news,
            ];
            return response()->json($data, 200); // Mengembalikan detail berita
        } else {
            $data = [
                'message' => 'Resource not found', // Mengembalikan pesan jika berita tidak ditemukan
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Menampilkan form untuk mengedit berita berdasarkan ID.
     */
    public function edit(string $id)
    {
        // Implementasi untuk form pengeditan berita (jika diperlukan)
    }

    /**
     * Memperbarui berita yang sudah ada di dalam database.
     */
    public function update(Request $request, string $id)
    {
        // Mencari berita berdasarkan ID
        $news = News::find($id);

        // Memeriksa apakah berita ditemukan
        if ($news) {
            // Menangkap data dari permintaan, menggunakan nilai default jika tidak ada
            $input = [
                'title' => $request->title ?? $news->title,
                'author' => $request->author ?? $news->author,
                'description' => $request->description ?? $news->description,
                'content' => $request->content ?? $news->content,
                'url' => $request->url ?? $news->url,
                'url_image' => $request->url_image ?? $news->url_image,
                'published_at' => $request->published_at ?? $news->published_at,
                'category' => $request->category ?? $news->category
            ];

            // Memperbarui data berita
            $news->update($input);

            $data = [
                'message' => 'Resource is Updated Successfully',
                'data' => $news // Mengembalikan berita yang telah diperbarui
            ];

            return response()->json($data, 200); // Mengembalikan respons sukses
        } else {
            $data = [
                'message' => 'Resource not found' // Mengembalikan pesan jika berita tidak ditemukan
            ];

            return response()->json($data, 404); // Mengembalikan respons kesalahan
        }
    }

    /**
     * Menghapus berita berdasarkan ID dari database.
     */
    public function destroy(string $id)
    {
        // Mencari berita berdasarkan ID
        $news = News::find($id);

        // Memeriksa apakah berita ditemukan
        if ($news) {
            $news->delete(); // Menghapus berita

            $data = [
                'message' => 'Resource is Delete Successfully' // Mengembalikan pesan sukses
            ];

            return response()->json($data, 200); // Mengembalikan respons sukses
        } else {
            $data = [
                'message' => 'Resource not found' // Mengembalikan pesan jika berita tidak ditemukan
            ];
            return response()->json($data, 404); // Mengembalikan respons kesalahan
        }
    }

    /**
     * Mencari berita berdasarkan judul.
     */
    public function search($title)
    {
        // Mencari berita yang judulnya mengandung kata kunci
        $news = News::where('title', 'like', '%' . $title . '%')->get();

        // Memeriksa apakah ada berita yang ditemukan
        if ($news->isEmpty()) {
            return response()->json([
                'message' => 'Resource not found', // Mengembalikan pesan jika tidak ada berita yang ditemukan
            ], 404);
        }

        return response()->json([
            'message' => 'Get searched resource',
            'data' => $news // Mengembalikan berita yang ditemukan
        ], 200);
    }

    /**
     * Mengambil berita dengan kategori 'sport'.
     */
    public function sport()
    {
        // Mencari berita dengan kategori 'sport'
        $news = News::where('category', 'sport')->get();

        // Memeriksa apakah ada berita yang ditemukan
        if ($news->isEmpty()) {
            return response()->json([
                'message' => 'Resource not found', // Mengembalikan pesan jika tidak ada berita yang ditemukan
            ], 404);
        }

        return response()->json([
            'message' => 'Get sport resource',
            'total' => $news->count(), // Mengembalikan jumlah berita yang ditemukan
            'data' => $news // Mengembalikan berita yang ditemukan
        ], 200);
    }

    /**
     * Mengambil berita dengan kategori 'finance'.
     */
    public function finance()
    {
        // Mencari berita dengan kategori 'finance'
        $news = News::where('category', 'finance')->get();

        // Memeriksa apakah ada berita yang ditemukan
        if ($news->isEmpty()) {
            return response()->json(['message' => 'No finance news found'], 404); // Mengembalikan pesan jika tidak ada berita yang ditemukan
        }

        return response()->json($news, 200); // Mengembalikan berita yang ditemukan
    }

    /**
     * Mengambil berita dengan kategori 'automotive'.
     */
    public function automotive()
    {
        // Mencari berita dengan kategori 'automotive'
        $news = News::where('category', 'automotive')->get();

        // Memeriksa apakah ada berita yang ditemukan
        if ($news->isEmpty()) {
            return response()->json([
                'message' => 'Resource not found', // Mengembalikan pesan jika tidak ada berita yang ditemukan
            ], 404);
        }

        return response()->json([
            'message' => 'Get automotive resource',
            'total' => $news->count(), // Mengembalikan jumlah berita yang ditemukan
            'data' => $news // Mengembalikan berita yang ditemukan
        ], 200);
    }
}
