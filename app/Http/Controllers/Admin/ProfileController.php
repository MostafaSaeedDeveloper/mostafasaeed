<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile', [
            'profile' => Profile::query()->first(),
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $profile = Profile::query()->firstOrNew();
        $profile->fill($request->validated());
        $profile->save();

        return redirect()->back()->with('status', __('messages.saved'));
    }
}
