<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudentRegistrationController;
use App\Http\Controllers\Api\UserRegisterCntroller;

Route::post('/students', [StudentController::class, 'store']);
Route::post('/register', [StudentRegistrationController::class, 'register']);
Route::post('/login', [StudentRegistrationController::class, 'login']);
Route::post('/registration', [UserRegisterCntroller::class, 'user_registration']);
