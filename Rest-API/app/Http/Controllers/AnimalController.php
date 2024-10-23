<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{

    private $animal = ['Jaguar', 'Platipus', 'Capybara', 'Tarantula'];

    public function index()
    {
        return response()->json(['Ini adalah Array Animals' => $this->animal]);
    }

    //Menambahkan Method Baru

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        array_push($this->animal, $request->name);

        return response()->json(['Message From API' => 'Array Berhasil di Tambahkan!', 'animal' => $this->animal]);
    }

    // Memperbaru Method Hewan

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        if (isset($this->animals[$id])) {
            $this->animal[$id] = $request->name;
            return response()->json(['Message From API' => 'Berhasil Memperbarui Data Animal!', 'animals' => $this->animal]);
        } else {
            return response()->json(['Message From API' => 'Tidak Ditemukan Data Hewan'], 404);
        }
    }


    // Menghapus Method Hewan

    public function destroy($id)
    {
        if (isset($this->animals[$id])) {
            unset($this->animals[$id]);
            $this->animal = array_values($this->animal);
            return response()->json(['Message From API' => 'Hewan berhasil dihapus!', 'animals' => $this->animal]);
        } else {
            return response()->json(['Message From API' => 'Hewan tidak ditemukan!'], 404);
        }
    }
}
