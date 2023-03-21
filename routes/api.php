<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});*/

Route::get('/auth/login/github',[\App\Http\Controllers\LoginController::class, 'loginWithGithub']);
Route::post('/auth/login/facebook',[\App\Http\Controllers\LoginController::class, 'loginWithFacebook']);
Route::post('/auth/login/google',[\App\Http\Controllers\LoginController::class, 'loginWithGoogle']);
Route::get('/auth/login/twitter',[App\Http\Controllers\LoginController::class, 'loginWithTwitter']);
Route::get('/auth/login/twitter/callback',[App\Http\Controllers\LoginController::class, 'twitterCallBack']);

//contents
Route::post('/academic/documents/upload',[App\Http\Controllers\AcademicController::class, 'save']);
Route::get('/academic/documents/{id}',[App\Http\Controllers\AcademicController::class, 'index']);

//Academic
Route::post('/contents',[App\Http\Controllers\AcademicController::class, 'contentSave']);
Route::get('/contents/{id}',[App\Http\Controllers\AcademicController::class, 'index']);


//permissions
Route::get('/permissions',[App\Http\Controllers\PermissionController::class, 'loadPermission']);

//users
Route::post('/users',[App\Http\Controllers\UserController::class, 'userSave']);
Route::get('/users',[App\Http\Controllers\UserController::class, 'index']);
Route::get('/users/{id}',[App\Http\Controllers\UserController::class, 'getUserById']);
Route::get('/users/upload/{id}',[App\Http\Controllers\UserController::class, 'uploadProfilePic']);


//login
Route::post('/login',[App\Http\Controllers\Auth\UserAuthController::class, 'login']);
