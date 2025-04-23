<?php

namespace App\Cms\Controllers;

use App\Http\Controllers\Controller;

use App\Cms\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{

//Użycie w kontrolerze formularza
    public function store(Request $request, ImageService $imageService)
    {
        if ($request->hasFile('image')) {
            $urls = $imageService->saveImageVersions($request->file('image'), auth()->id());
            // np. zapis do bazy $urls['max'], $urls['min']
        }

        // ...zapis artykułu
    }

//Użycie z TinyMCE (endpoint do uploadu)
    public function uploadTinyMce(Request $request, ImageService $imageService)
    {
        $userId = auth()->id();// Auth()->user()1;

        DB::table('system_debug')->insert(['value' => serialize($request->file('file'))]);

        if ($request->hasFile('file')) {
            $urls = $imageService->saveImageVersions($request->file('file'), $userId);//auth()->id());
            return response()->json([
                'location' => $urls['max'] // TinyMCE wymaga pola "location"
            ]);
        }
        return response()->json(['error' => 'Brak pliku'], 400);
//        if ($request->hasFile('file')) {
//            $urls = $imageService->saveImageVersions($request->file('file'), auth()->id());
//
//            return response()->json([
//                'location' => $urls['max'] // TinyMCE wymaga pola "location"
//            ]);
//        }
//
//        return response()->json(['error' => 'Brak pliku'], 422);
    }


    //testy do wyjebania
    public function form()
    {
        return view('cms.article.create-article');
    }

    public function upload(Request $request, ImageService $imageService)
    {
        $request->validate([
            'image' => 'required|image|max:30720', // max 5MB
        ]);

        $userId = 1;// auth()->id() ?? 1; // na testy możesz ustawić 1
        $urls = $imageService->saveImageVersions($request->file('image'), $userId);

        return redirect()->route('image.form')->with([
            'success' => 'Zdjęcie zapisane pomyślnie!',
            'max' => $urls['max'],
            'min' => $urls['min'],
        ]);
    }
}

