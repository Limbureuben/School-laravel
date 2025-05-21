<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StudentRegistrationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'nullable|string',
        ]);

        do {
            $regNo = 'S' . rand(100000, 999999);
        } while (StudentRegistration::where('reg_no', $regNo)->exists());

        $studentData = [
            'first_name' => $request->first_name,
            'last_name'=> $request->last_name,
            'reg_no' => $regNo,
            'password' => Hash::make($request->last_name),
        ];

        if ($request->filled('gender')) {
            $studentData['gender'] = $request->gender;
        }

        $student = StudentRegistration::create($studentData);

        return response()->json([
            'message' => 'Student registered successfully',
            'reg_no' => $student->reg_no,
            'default_password' => $request->last_name,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'reg_no' => 'required|string',
            'password' => 'required|string',
        ]);

        $student = StudentRegistration::where('reg_no', $request->reg_no)->first();

        if (!$student) {
            return response()->json(['message' => 'Invalid registration number or password'], 401);
        }

        if (!Hash::check($request->password, $student->password)) {
            return response()->json(['message' => 'Invalid registration number or password'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'student' => [
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'gender' => $student->gender,
                'reg_no' => $student->reg_no
            ],
        ]);

    }

}
