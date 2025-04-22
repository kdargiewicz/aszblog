<?php

use Illuminate\Support\Facades\Route;
use App\Cms\Controllers\ImageController;
use App\Mail\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.show');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/api/check-verification', function () {
    return response()->json([
        'verified' => auth()->check() && auth()->user()->hasVerifiedEmail()
    ]);
})->middleware('auth')->name('api.check-verification');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/cms/image/test', [ImageController::class, 'form'])->name('image.form');
    Route::post('/cms/image/upload', [ImageController::class, 'upload'])->name('image.upload');
    Route::post('/tinymce/upload', [ImageController::class, 'uploadTinyMce'])->name('tiny-mce-upload.store');


    Route::post('/storeArticle', [\App\Cms\Controllers\ArticleController::class, 'postStoreArticle'])->name('article.store');

    Route::get('/kontakt', [ContactController::class, 'showForm'])->name('contact.form');
    Route::post('/kontakt', [ContactController::class, 'submit'])->name('contact.submit');
});


