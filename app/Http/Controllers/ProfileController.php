<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\User;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProfileRequest $request)
    {
        $user = auth()->user();

        $user->update($request->all());

        return redirect(url()->previous())->with('flashMessage', ['description' => 'Profile update successfully', 'type' => 'success']);
    }
}