<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'regNo' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $student = Student::create ($validated);

        return response()->json([
            'message' => 'Student registred successfully',
            'data' => $student
        ], 201);
    }
}
