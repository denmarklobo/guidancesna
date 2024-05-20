<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\StudentProfilingController;
use App\Http\Controllers\ImageController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    $user->load('studentProfile');
});
//STUDENT PROFILE HANDLNNG
// Route::post('/login', [StudentLoginController::class, 'authenticate']);
Route::get('student',[StudentProfilingController::class,'index']);
Route::get('student/{id}',[StudentProfilingController::class,'indexId']);
Route::post('student',[StudentProfilingController::class,'upload']);
Route::put('student/edit/{id}',[StudentProfilingController::class,'edit']);
Route::delete('student/edit/{id}',[StudentProfilingController::class,'delete']);


Route::post('/archive', [CasesController::class, 'archive']);

Route::prefix('cases')->group(function () {
    Route::get('/', [CasesController::class, 'index']);
    Route::post('/', [CasesController::class, 'store']);
    Route::get('/{id}', [CasesController::class, 'show']);
    Route::put('/{id}', [CasesController::class, 'update']);
    Route::get('/{id}', [CasesController::class, 'caseStatusUpdate']);
    Route::delete('/{id}', [CasesController::class, 'destroy']);
});

// Routes for ExaminationController
Route::prefix('examinations')->group(function () {
    Route::get('/', [ExaminationController::class, 'index']);
    Route::post('/', [ExaminationController::class, 'store']);
    Route::get('/{id}', [ExaminationController::class, 'show']);
    Route::put('/{id}', [ExaminationController::class, 'update']);
    Route::delete('/{id}', [ExaminationController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
