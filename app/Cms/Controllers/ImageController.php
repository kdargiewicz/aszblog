<?php

namespace App\Cms\Controllers;

use App\Http\Controllers\Controller;
use App\Cms\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadTinyMce(Request $request, ImageService $imageService)
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

