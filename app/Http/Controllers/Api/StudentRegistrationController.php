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
            'gender' => 'required|string',
        ]);

        do {
            $regNo = 'S' . rand(100000, 999999);
        } while (StudentRegistration::where('reg_no', $regNo)->exists());

        $student = StudentRegistration::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'reg_no' => $regNo,
            'password' => Hash::make($request->last_name),
        ]);

        return response()->json([
            'message' => 'Student registred successfully',
            'reg_no' => $student->reg_no,
            'default_password' => $request->last_name,
        ], 201);
    }
}
