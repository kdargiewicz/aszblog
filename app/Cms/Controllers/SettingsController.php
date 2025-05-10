<?php

namespace App\Cms\Controllers;

use App\Cms\Models\UserSetting;
use App\Cms\Services\ImageService;
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

    /**
     * @throws \JsonException
     */
    public function postStoreSettings(UserSettingsRequest $request): \Illuminate\Http\RedirectResponse
    {
        $userId = auth()->id();
        $validated = $request->validated();

        $images = $this->processUploadedImages($request, $userId);

        UserSetting::updateOrCreate(
            ['user_id' => $userId],
            [
                'avatar' => $images['avatar'],
                'main_image' => $images['main_image'],
                'about_me_image' => $images['about_me_image'],
                'about_me' => $validated['about_me'] ?? null,
                'my_motto' => $validated['my_motto'] ?? null,
                'blog_template' => $validated['blog_template'] ?? null,
            ]
        );

        return redirect()
            ->route('user.settings')
            ->with('success', __('flash-messages.user-settings-updated'));
    }

    /**
     * @throws \JsonException
     */
    public function postUpdateSettings(UserSettingsRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $userId = auth()->id();
        $validated = $request->validated();
        $settings = UserSetting::where('user_id', $userId)->firstOrFail();

        $images = $this->processUploadedImages($request, $userId);

        $insert = [
            'avatar' => $images['avatar'] ?? $settings->avatar,
            'main_image' => $images['main_image'] ?? $settings->main_image,
            'about_me_image' => $images['about_me_image'] ?? $settings->about_me_image,
            'about_me' => $validated['about_me'] ?? $settings->about_me,
            'my_motto' => $validated['my_motto'] ?? $settings->my_motto,
            'blog_template' => $validated['blog_template'] ?? $settings->blog_template,
        ];

        app(UserSetting::class)->postUpdateSettings($userId, $insert);

        return redirect()
            ->route('user.settings')
            ->with('success', __('flash-messages.user-settings-updated'));
    }

    /**
     * @throws \JsonException
     */
    private function processUploadedImages($request, int $userId): array
    {
        $folder = 'settings';
        $type = 'user-settings';

        /** @var ImageService $imageService */
        $imageService = app(ImageService::class);

        return [
            'avatar' => $request->hasFile('avatar')
                ? $imageService->saveImageVersions($request->file('avatar'), $userId, $folder, $type)['max'] ?? null
                : null,

            'main_image' => $request->hasFile('main_image')
                ? $imageService->saveImageVersions($request->file('main_image'), $userId, $folder, $type)['max'] ?? null
                : null,

            'about_me_image' => $request->hasFile('about_me_image')
                ? $imageService->saveImageVersions($request->file('about_me_image'), $userId, $folder, $type)['max'] ?? null
                : null,
        ];
    }

//    public function postStoreSettings(UserSettingsRequest $request): \Illuminate\Http\RedirectResponse
//    {
//        $validated = $request->validated();
//
//        $userId = auth()->id();
//        $folder = 'settings';
//        $type = 'user-settings';
//
//        /** @var \App\Cms\Services\ImageService $imageService */
//        $imageService = app(\App\Cms\Services\ImageService::class);
//
//        $avatarPaths = null;
//        $mainImagePaths = null;
//
//        if ($request->hasFile('avatar')) {
//            $avatarPaths = $imageService->saveImageVersions(
//                $request->file('avatar'),
//                $userId,
//                $folder,
//                $type
//            );
//        }
//
//        if ($request->hasFile('main_image')) {
//            $mainImagePaths = $imageService->saveImageVersions(
//                $request->file('main_image'),
//                $userId,
//                $folder,
//                $type
//            );
//        }
//
//        if ($request->hasFile('about_me_image')) {
//            $aboutMeImagePaths = $imageService->saveImageVersions(
//                $request->file('about_me_image'),
//                $userId,
//                $folder,
//                $type
//            );
//        }
//
//
//        $settings = \App\Cms\Models\UserSetting::updateOrCreate(
//            ['user_id' => $userId],
//                [
//                    'avatar' => $avatarPaths['max'] ?? null,
//                    'main_image' => $mainImagePaths['max'] ?? null,
//                    'about_me' => $validated['about_me'] ?? null,
//                    'my_motto' => $validated['my_motto'] ?? null,
//                    'blog_template' => $validated['blog_template'] ?? null,
//                    'about_me_image' => $aboutMeImagePaths['max'] ?? null,
//                ]
//        );
//
//        return redirect()
//            ->route('user.settings')
//            ->with('success', __('flash-messages.user-settings-updated'));
//    }
//
//    public function postUpdateSettings(UserSettingsRequest $request, $id): \Illuminate\Http\RedirectResponse
//    {
//        $validated = $request->validated();
//
//        $userId = auth()->id();
//        $folder = 'settings';
//        $type = 'user-settings';
//
//        /** @var \App\Cms\Services\ImageService $imageService */
//        $imageService = app(\App\Cms\Services\ImageService::class);
//
//        $settings = \App\Cms\Models\UserSetting::where('user_id', $userId)->firstOrFail();
//
//        $avatarPaths = null;
//        $mainImagePaths = null;
//
//        if ($request->hasFile('avatar')) {
//            $avatarPaths = $imageService->saveImageVersions(
//                $request->file('avatar'),
//                $userId,
//                $folder,
//                $type
//            );
//        }
//
//        if ($request->hasFile('main_image')) {
//            $mainImagePaths = $imageService->saveImageVersions(
//                $request->file('main_image'),
//                $userId,
//                $folder,
//                $type
//            );
//        }
//
//        if ($request->hasFile('about_me_image')) {
//            $aboutMeImagePaths = $imageService->saveImageVersions(
//                $request->file('about_me_image'),
//                $userId,
//                $folder,
//                $type
//            );
//        }
//
//        $insert = [
//            'avatar' => $avatarPaths['max'] ?? $settings->avatar,
//            'main_image' => $mainImagePaths['max'] ?? $settings->main_image,
//            'about_me' => $validated['about_me'] ?? $settings->about_me,
//            'my_motto' => $validated['my_motto'] ?? $settings->my_motto,
//            'blog_template' => $validated['blog_template'] ?? $settings->blog_template,
//            'about_me_image' => $aboutMeImagePaths['max'] ?? null,
//        ];
//
//        app(UserSetting::class)->postUpdateSettings($userId, $insert);
//
//        return redirect()
//            ->route('user.settings')
//            ->with('success', __('flash-messages.user-settings-updated'));
//    }

}
