<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

Route::post('/students', [StudentController::class, 'store']);
Route::post('/student/register', [StudentRegistrationController::class, 'register']);
