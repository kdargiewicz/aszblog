<?php

namespace App\Cms\Controllers;

use App\Cms\Models\UserSetting;
use App\Http\Controllers\Controller;
use App\Cms\Requests\UserSettingsRequest;

class SettingsController extends Controller
{
    public function getSettings(): object
    {
        $settings = app(UserSetting::class)->getUserSettings(auth()->id());
        $isBlogOwner = app(UserSetting::class)->isBlogOwner(auth()->id());

        return view('cms.settings.main')
            ->with('settings', $settings)
            ->with('isBlogOwner', $isBlogOwner);
    }

    public function postStoreSettings(UserSettingsRequest $request)
    {
        $validated = $request->validated();

        $userId = auth()->id(); // lub $request->user()->id
        $folder = 'settings';
        $type = 'user-settings';

        /** @var \App\Cms\Services\ImageService $imageService */
        $imageService = app(\App\Cms\Services\ImageService::class);

        $avatarPaths = null;
        $mainImagePaths = null;

        // Jeśli jest avatar — zapisujemy
        if ($request->hasFile('avatar')) {
            $avatarPaths = $imageService->saveImageVersions(
                $request->file('avatar'),
                $userId,
                $folder,
                $type
            );
        }

        // Jeśli jest main_image — zapisujemy
        if ($request->hasFile('main_image')) {
            $mainImagePaths = $imageService->saveImageVersions(
                $request->file('main_image'),
                $userId,
                $folder,
                $type
            );
        }

        // Tworzymy lub aktualizujemy user_settings
        $settings = \App\Cms\Models\UserSetting::updateOrCreate(
            ['user_id' => $userId],
            [
                'avatar' => $avatarPaths['max'] ?? null,
                'main_image' => $mainImagePaths['max'] ?? null,
                'about_me' => $validated['about_me'] ?? null,
                'my_motto' => $validated['my_motto'] ?? null,
                'blog_template' => $validated['blog_template'] ?? null,
            ]
        );

        return redirect()
            ->route('user.settings')
            ->with('success', __('flash-messages.user-settings-updated'));
    }


//    public function postStoreSettings(UserSettingsRequest $request)
//    {
//        $validated = $request->validated();
//
//
//        "avatar" =>
//
// {#1266 ▶}
//     "main_image" =>
//
// {#1267 ▶}
//     "about_me" => "aaa"
//  "my_motto" => "bbb"
//  "blog_template" => "one"
//
//
//        dd($validated);
//    }

    public function postUpdateSettings(UserSettingsRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $userId = auth()->id();
        $folder = 'settings';
        $type = 'user-settings';

        /** @var \App\Cms\Services\ImageService $imageService */
        $imageService = app(\App\Cms\Services\ImageService::class);

        $settings = \App\Cms\Models\UserSetting::where('user_id', $userId)->firstOrFail();

        $avatarPaths = null;
        $mainImagePaths = null;

        if ($request->hasFile('avatar')) {
            $avatarPaths = $imageService->saveImageVersions(
                $request->file('avatar'),
                $userId,
                $folder,
                $type
            );
        }

        if ($request->hasFile('main_image')) {
            $mainImagePaths = $imageService->saveImageVersions(
                $request->file('main_image'),
                $userId,
                $folder,
                $type
            );
        }

        $insert = [
            'avatar' => $avatarPaths['max'] ?? $settings->avatar,
            'main_image' => $mainImagePaths['max'] ?? $settings->main_image,
            'about_me' => $validated['about_me'] ?? $settings->about_me,
            'my_motto' => $validated['my_motto'] ?? $settings->my_motto,
            'blog_template' => $validated['blog_template'] ?? $settings->blog_template,
        ];

        app(UserSetting::class)->postUpdateSettings($userId, $insert);

        return redirect()
            ->route('user.settings')
            ->with('success', __('flash-messages.user-settings-updated'));
    }

}
