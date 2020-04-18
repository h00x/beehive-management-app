<?php

namespace App\Http\Controllers;

use App\Helpers\ProfileHelper;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'language' => $request->language,
            'uses_metric' => $request->unit_system === 'metric' ? true : false,
        ];

        if ($request->hasFile('profile_image')) {
            $data['profile_image_name'] = ProfileHelper::storeProfileImage($request, $user);
        }

        $user->update($data);

        return redirect(route('profile.index'))->with('flashMessage', ['description' => 'Profile updated successfully', 'type' => 'success']);
    }

    public function removeImage()
    {
        $user = auth()->user();

        Storage::delete('public/images/profiles/'.$user->profile_image_name.'.jpg');

        $user->update([
            'profile_image_name' => null
        ]);

        return redirect(route('profile.index'))->with('flashMessage', ['description' => 'Profile image deleted', 'type' => 'success']);
    }
}
