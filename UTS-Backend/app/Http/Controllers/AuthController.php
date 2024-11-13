<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Kontroler untuk mengelola autentikasi pengguna
class AuthController extends Controller
{
    /**
     * Mendaftarkan pengguna baru.
     */
    public function register(Request $request)
    {
        // Menangkap input dari permintaan
        $input = [
            'name' => $request->name, // Nama pengguna
            'email' => $request->email, // Email pengguna
            'password' => Hash::make($request->password), // Menghash password sebelum disimpan
        ];

        // Membuat pengguna baru di database
        $user = User::create($input);

        // Menyiapkan data respons
        $data = [
            'message' => 'User  is created successfully' // Pesan sukses
        ];

        // Mengembalikan respons JSON dengan status 200 OK
        return response()->json($data, 200);
    }

    /**
     * Mengautentikasi pengguna dan melakukan login.
     */
    public function login(Request $request)
    {
        // Menangkap input dari permintaan
        $input = [
            'email' => $request->email, // Email pengguna
            'password' => $request->password // Password pengguna
        ];

        // Mengambil data pengguna dari database berdasarkan email
        $user = User::where('email', $input['email'])->first();

        // Memeriksa apakah email dan password yang dimasukkan cocok dengan data di database
        $isLoginSuccessfully = (
            $user && // Memastikan pengguna ditemukan
            Hash::check($input['password'], $user->password) // Memeriksa password
        );

        // Jika login berhasil
        if ($isLoginSuccessfully) {
            // Membuat token autentikasi untuk pengguna
            $token = $user->createToken('auth_token');

            // Menyiapkan data respons
            $data = [
                'message' => 'Login successfully', // Pesan sukses
                'token' => $token->plainTextToken // Token autentikasi
            ];

            // Mengembalikan respons JSON dengan status 200 OK
            return response()->json($data, 200);
        } else {
            // Jika login gagal, mengembalikan pesan error
            $data = [
                'message' => 'Username or Password is wrong' // Pesan kesalahan
            ];

            // Mengembalikan respons JSON dengan status 401 Unauthorized
            return response()->json($data, 401);
        }
    }
}
