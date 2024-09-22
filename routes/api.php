<?php

use App\Http\Controllers\AnnouncmentsApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataDisplayOptionsApiController;
use App\Http\Controllers\FeedbackApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

/**********************************   Login & Regidter & Logout   *******************************************/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

/**********************************   Announcements Url's    *******************************************/
Route::get('/Announcements',[AnnouncmentsApiController::class,'index'])->middleware('auth:sanctum');
Route::get('/Announcements/{id}',[AnnouncmentsApiController::class,'show'])->middleware('auth:sanctum');
Route::post('/Announcements/st',[AnnouncmentsApiController::class,'store'])->middleware('auth:sanctum');
Route::post('/Announcements/up/{id}',[AnnouncmentsApiController::class,'update'])->middleware('auth:sanctum');
Route::delete('/Announcements/del/{id}',[AnnouncmentsApiController::class,'destroy'])->middleware('auth:sanctum');

/**********************************   DataOptions Url's    *******************************************/
Route::get('/DataOptions',[DataDisplayOptionsApiController::class,'index'])->middleware('auth:sanctum');
Route::post('/DataOptions/st',[DataDisplayOptionsApiController::class,'store'])->middleware('auth:sanctum');
Route::delete('/DataOptions/del/{id}',[DataDisplayOptionsApiController::class,'destroy'])->middleware('auth:sanctum');

/**********************************   Feedback Url's    *******************************************/
Route::get('/Feedback',[FeedbackApiController::class,'index'])->middleware('auth:sanctum');
Route::get('/Feedback/{id}',[FeedbackApiController::class,'show'])->middleware('auth:sanctum');
Route::post('/Feedback/st',[FeedbackApiController::class,'store'])->middleware('auth:sanctum');
Route::post('/Feedback/up/{id}',[FeedbackApiController::class,'update'])->middleware('auth:sanctum');
Route::delete('/Feedback/del/{id}',[FeedbackApiController::class,'destroy'])->middleware('auth:sanctum');