<?php

use Illuminate\Support\Facades\Route;
use App\Cms\Controllers\ImageController;
use App\Mail\Controllers\ContactController;

Route::get('/cms/image/test', [ImageController::class, 'form'])->name('image.form');
Route::post('/cms/image/upload', [ImageController::class, 'upload'])->name('image.upload');
Route::post('/tinymce/upload', [ImageController::class, 'uploadTinyMce'])->name('tiny-mce-upload.store');


Route::post('/storeArticle', [\App\Cms\Controllers\ArticleController::class, 'postStoreArticle'])->name('article.store');

Route::get('/kontakt', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/kontakt', [ContactController::class, 'submit'])->name('contact.submit');



Route::get('/', function () {
    return view('welcome');
});
