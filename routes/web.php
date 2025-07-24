<?php

use App\Cms\Controllers\ArticleDraftController;
use App\Http\Middleware\CheckBlogPublished;
use App\Web\Controllers\MailContactController;
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

Route::post('/store-comment', [WebCommentsController::class, 'storeComment'])->name('comment.store');
Route::post('/contact/send', [MailContactController::class, 'sendMailFromReader'])->name('contact.send');

Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
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

Route::middleware(['auth', 'verified', ForcePasswordChangeMiddleware::class])->group(function () {

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
    Route::post('/updateArticle', [\App\Cms\Controllers\ArticleController::class, 'postStoreUpdate'])->name('article.update');
    Route::get('/articleList', [\App\Cms\Controllers\ArticleController::class, 'getArticleList'])->name('article.list');
    Route::get('/mainPhotoInArticle', [\App\Cms\Controllers\ImageController::class, 'getMainPhotoInArticle'])->name('main-photo-in-article');
    Route::post('/storeMainPhotosInArticles', [\App\Cms\Controllers\ImageController::class, 'postStoreMainImagesInArticles'])->name('store-main-photos-in-articles');
    Route::get('/articleDeleteList', [\App\Cms\Controllers\ArticleController::class, 'getDeleteArticleList'])->name('article.list.delete');
    Route::post('updatePublishedArticle', [\App\Cms\Controllers\ArticleController::class, 'postUpdatePublishedArticle'])->name('article.update.published');
    Route::post('/articleRestore/{articleId}', [\App\Cms\Controllers\ArticleController::class, 'postArticleRestore'])->name('article.restore');

    //autosave article
    Route::post('/article/draft/autosave', [ArticleDraftController::class, 'autosave'])->name('article.draft.autosave');


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

//Blog official
Route::middleware([
    LogVisitMiddleware::class,
    CheckBlogPublished::class, // dodajemy klasę bez aliasu
])->group(function () {
    Route::get('/', [\App\Web\Controllers\BlogController::class, 'welcome'])->name('welcome');
    Route::get('/galeria', [\App\Web\Controllers\BlogController::class, 'getGallery'])->name('blog.gallery');
    Route::get('/o-autorze', [\App\Web\Controllers\BlogController::class, 'getAboutMe'])->name('blog.about-me');
    Route::get('/kontakt', [\App\Web\Controllers\BlogController::class, 'getContact'])->name('blog.contact');
    Route::get('/mapa', [\App\Web\Controllers\BlogController::class, 'getBlogMap'])->name('blog.google-map');
    Route::get('/polityka-prywatnosci', [\App\Web\Controllers\BlogController::class, 'getPrivacyPolicy'])->name('blog.privacy-policy');
    Route::get('/{categorySlug}/{articleSlug}', [\App\Web\Controllers\BlogController::class, 'getViewArticleBySlug'])->name('blog.article.slug');
});
//END BLOG OFFICIAL ROUTES



