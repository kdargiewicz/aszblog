<?php

use App\Web\Controllers\WebCommentsController;
use Illuminate\Support\Facades\Route;
use App\Cms\Controllers\ImageController;
use App\Mail\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\LogVisitMiddleware;
use App\Http\Middleware\ForcePasswordChangeMiddleware;

//test error
use Illuminate\Auth\Access\AuthorizationException;
use App\Cms\Repositories\ErrorsRepository;

//tutaj daje routy do zliczania odwiedzin na blogu bez auth
//Route::middleware(LogVisitMiddleware::class)->group(function () {
  //  Route::get('/createArticle', [\App\Cms\Controllers\ArticleController::class, 'getCreateArticle'])->name('article.create');
//    Route::get('/article/{slug}', [ArticleController::class, 'show']);
//    Route::get('/category/{name}', [CategoryController::class, 'show']);
//});

//moge tez wywolac to w pojedynczym route, np:
//Route::get('/article/{slug}', [ArticleController::class, 'show'])
//    ->middleware(LogVisitMiddleware::class);


Route::post('/store-comment', [WebCommentsController::class, 'storeComment'])->name('comment.store');




Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    //->name('verification.show');
    ->name('verification.notice');


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

//Auth::routes(['verify' => true]);
//Route::middleware(['auth', 'verified'])->group(function () { /// ----->> TEN ROUTE DAJ BO TYM NIZEJ MIERZE ODWIEDZINY A TO WYZEJ MAM MIERZYC ODWIEDZINY
Route::middleware(['auth', 'verified', ForcePasswordChangeMiddleware::class, LogVisitMiddleware::class])->group(function () {

    Route::get('/dashboard', function (\App\Web\Services\VisitTrackerService $tracker) {
        $browserStatsData = $tracker->getBrowserStatsByTopUrls();
        return view('dashboard', [
            'visitCounter' => $tracker->getCountAllVisit(),
            'dailyVisits' => $tracker->getAllData(),
            'browserStats' => $tracker->getBrowserStats(),
            'weekdayStats' => $tracker->getWeekdayStats(),
            'typeStats' => $tracker->getTypeStats(),
            'urlStats' => $tracker->getUrlStats(),
            'topUrls' => $browserStatsData['topUrls'],
            'browserStatsByUrl' => $browserStatsData['browserStatsByUrl'],
            'articleCounter' => app(\App\Cms\Repositories\ArticleRepository::class)->getCountArticleFromUser(),
        ]);
    })->name('dashboard');

    // LISTA błędów
    Route::get('/errors', function (ErrorsRepository $errors) {
        return view('cms.errors-log', [
            'errors' => $errors->getErrors(), // tutaj kolekcja błędów
        ]);
    })->middleware(['auth', 'admin'])->name('errors.log');

// SZCZEGÓŁY pojedynczego błędu
    Route::get('/error/{id}', function ($id, ErrorsRepository $errors) {
        $error = $errors->getErrorById($id);

        if (!$error) {
            abort(404);
        }

        return view('cms.error-details', [
            'error' => $error,
        ]);
    })->middleware(['auth', 'admin'])->name('error.show');


    Route::post('/cms/image/upload', [ImageController::class, 'upload'])->name('image.upload');
    Route::post('/tinymce/upload', [ImageController::class, 'uploadTinyMce'])->name('tiny-mce-upload.store');



    Route::get('/createArticle', [\App\Cms\Controllers\ArticleController::class, 'getCreateArticle'])->name('article.create');
    Route::post('/storeArticle', [\App\Cms\Controllers\ArticleController::class, 'postStoreArticle'])->name('article.store');

    //tu jakiej id trzeba przekazac niejawnie?
    Route::get('/editArticle/{uuid}', [\App\Cms\Controllers\ArticleController::class, 'getEditArticle'])->name('article.edit');

    Route::delete('/article/{article}', [\App\Cms\Controllers\ArticleController::class, 'postArticleDelete'])->name('article.delete');

    //testy errorow
    Route::get('/test-error-500', function () {
        throw new \Exception('To jest testowy błąd 500');
    });

    Route::get('/test-error-404', function () {
        abort(404);
    });

    Route::get('/test-error-403', function () {
        throw new AuthorizationException('Brak dostępu do tej funkcji');
    });

    Route::get('/test-error-419', function () {
        abort(419); // np. CSRF Token mismatch
    });

    Route::post('/updateArticle', [\App\Cms\Controllers\ArticleController::class, 'postStoreUpdate'])->name('article.update');

    Route::get('/articleList', [\App\Cms\Controllers\ArticleController::class, 'getArticleList'])->name('article.list');

    Route::get('/articleDeleteList', [\App\Cms\Controllers\ArticleController::class, 'getDeleteArticleList'])->name('article.list.delete');




    Route::post('/articleRestore/{articleId}', [\App\Cms\Controllers\ArticleController::class, 'postArticleRestore'])->name('article.restore');


    Route::get('/kontakt', [ContactController::class, 'showForm'])->name('contact.form');
    Route::post('/kontakt', [ContactController::class, 'submit'])->name('contact.submit');

    //podglad wersji bloga
    Route::get('/preview/{name}', [\App\Web\Controllers\PreviewController::class, 'getPreviewBlogByBlogName'])->name('first.blog.preview');
    Route::get('/article-preview/{articleId}', [\App\Web\Controllers\PreviewController::class, 'getPreviewArticle'])->name('article.preview');
    Route::get('/gallery', [\App\Web\Controllers\PreviewController::class, 'getGallery'])->name('gallery.preview');
    Route::get('/about-me', [\App\Web\Controllers\PreviewController::class, 'getAboutMe'])->name('about-me');
    Route::get('/contact', [\App\Web\Controllers\PreviewController::class, 'getContact'])->name('contact');
    Route::get('/blog-map', [\App\Web\Controllers\PreviewController::class, 'getBlogMap'])->name('blog.map');

    //settings
    Route::get('/settings', [\App\Cms\Controllers\SettingsController::class, 'getSettings'])->name('user.settings');
    Route::post('/store-settings', [\App\Cms\Controllers\SettingsController::class, 'postStoreSettings'])->name('user_settings.store');
    Route::post('/update-settings{settingsId}', [\App\Cms\Controllers\SettingsController::class, 'postUpdateSettings'])->name('user_settings.update');

    //komentarze
    Route::get('/comments', [\App\Cms\Controllers\CommentsController::class, 'getComments'])->name('comments.list');
    Route::post('/comment-accept/{id}', [\App\Cms\Controllers\CommentsController::class, 'toggleAccept'])->name('comment.accept');

});


