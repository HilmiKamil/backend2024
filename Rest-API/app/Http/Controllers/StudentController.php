<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $student = Student::all();

        if ($student) {
            $data = [
                'message' => 'Get All Students',
                'data' => $student,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data Failed Get'
            ];
        }

        return response()->json($data, 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];

        $student = Student::create($input);

        if ($student) {
            $data = [
                'message' => 'Data Update Success',
                'data' => $student,
            ];
            return response()->json($data, 201);
        } else {
            $data = [
                'message' => 'Data Failed Updated'
            ];
        }

        return response()->json($data, 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $student = Student::find($id);

        if ($student) {
            $data = [
                'message' => 'Get detail student',
                'data' => $student,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found',
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if ($student) {
            #menangkap data request
            $input = [
                'nama' => $request->nama ?? $student->nama,
                'nim' => $request->nim ?? $student->nim,
                'email' => $request->email ?? $student->email,
                'jurusan' => $request->jurusan ?? $student->jurusan

            ];

            #update data
            $student->update($input);

            $data = [
                'message' => 'Student data updated successfully',
                'data' => $student
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];

            return response()->json($data, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();

            $data = [
                'message' => 'Student is deleted'
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Student not found'
            ];
            return response()->json($data, 404);
        }
    }
}
