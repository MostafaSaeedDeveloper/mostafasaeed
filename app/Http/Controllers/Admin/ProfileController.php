<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Services\UploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(private readonly UploadService $uploadService)
    {
    }

    public function edit(): View
    {
        $profile = Profile::first();

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $profile = Profile::firstOrCreate([]);

        if ($request->hasFile('profile_image')) {
            $this->uploadService->delete($profile->profile_image_path);
            $profile->profile_image_path = $this->uploadService->store($request->file('profile_image'), 'uploads/profile');
        }

        if ($request->hasFile('cv')) {
            $this->uploadService->delete($profile->cv_path);
            $profile->cv_path = $this->uploadService->store($request->file('cv'), 'uploads/cv');
        }

        $profile->update([
            'name' => $request->string('name')->toString(),
            'titles' => [
                'en' => $request->input('titles_en'),
                'ar' => $request->input('titles_ar'),
            ],
            'bio' => [
                'en' => $request->input('bio_en'),
                'ar' => $request->input('bio_ar'),
            ],
            'skills' => $request->input('skills') ? array_map('trim', explode(',', $request->input('skills'))) : [],
            'profile_image_path' => $profile->profile_image_path,
            'cv_path' => $profile->cv_path,
            'social_links' => $request->input('social_links', []),
        ]);

        return redirect()->route('admin.profile.edit')->with('success', __('app.saved_successfully'));
    }
}
