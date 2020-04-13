<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('change-password', compact('user'));
    }

    public function update(ChangePasswordRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect(url()->previous())->with('flashMessage', ['description' => 'Password updated successfully', 'type' => 'success']);
    }
}
