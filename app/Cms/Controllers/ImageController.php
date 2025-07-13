<?php

namespace App\Cms\Controllers;

use App\Cms\Models\Image;
use App\Http\Controllers\Controller;
use App\Cms\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadTinyMce(Request $request, ImageService $imageService): \Illuminate\Http\JsonResponse
    {
        $userId = auth()->id();

        $request->validate([
            'file' => 'required|image',
            'article_uuid' => 'nullable|uuid',
            'type' => 'nullable|string|in:article,avatar,background,other'
        ]);

        $uuid = $request->input('article_uuid');
        $type = $request->input('type', 'article');

        if ($request->hasFile('file')) {
            $urls = $imageService->saveImageVersions($request->file('file'), $userId, 'articles', $type, $uuid);

            return response()->json([
                'location' => $urls['max']
            ]);
        }

        return response()->json(['error' => 'Brak pliku'], 400);
    }

    public function getMainPhotoInArticle(): object
    {
        $articleImagesList = app(Image::class)->getAllImagesFromArticles();

        return view('cms.article.mainPhotoInArticle', compact('articleImagesList'));
    }

    public function postStoreMainImagesInArticles(Request $request)
    {
        $userId = auth()->id();
        $mainImages = $request->input('main_image', []);

        $errors = [];

        foreach ($mainImages as $articleId => $imageId) {
            if (!is_numeric($articleId) || !is_numeric($imageId)) {
                $errors[] = __('errors.invalid_article_or_image_id', [
                    'article_id' => $articleId,
                    'image_id' => $imageId,
                ]);
                continue;
            }

            $existsImageOnArticle = app(Image::class)->existsImageOnArticle($imageId, $articleId, $userId);

            if (!$existsImageOnArticle) {
                $errors[] = __('errors.image_not_belongs_to_article_or_user', [
                    'article_id' => $articleId,
                    'image_id' => $imageId,
                ]);

            }
        }

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        foreach ($mainImages as $articleId => $imageId) {
            \App\Cms\Models\Image::where('article_id', $articleId)->update(['is_main_photo' => false]);
            \App\Cms\Models\Image::where('id', $imageId)->update(['is_main_photo' => true]);
        }

        return back()->with('success', __('flash_messages.articles_main_photos_saved'));
    }

    public function upload(Request $request, ImageService $imageService)
    {
        $request->validate([
            'image' => 'required|image|max:30720',
        ]);

        $userId = auth()->id();
        $type = isset($type) ? $type : 'inne';
        $folder = isset($folder) ? $type : 'inny_folder';
        $urls = $imageService->saveImageVersions($request->file('image'), $userId, $folder, $type);

        dd($urls);

        return redirect()->route('image.form')->with([
            'success' => 'Zdjęcie zapisane pomyślnie!',
            'max' => $urls['max'],
            'min' => $urls['min'],
        ]);
    }
}

