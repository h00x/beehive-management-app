@extends('layouts.app')

@section('pageTitle', 'Profile of ' . $user->name)

@section('content')
    <div class="form-content flex -mx-4 justify-center">
        <div class="w-1/2 px-4 my-4">
            <div class="shadow rounded-lg p-6 bg-white h-full relative">
                <h2 class="text-3xl mb-4">Change password</h2>
                <form action="{{ route('changePassword.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="field">
                        <label for="old_password" class="@error('name') text-red-500 @enderror">Old password</label>
                        <div class="control">
                            <input type="password" name="old_password" id="old_password" class="border-gray-200 border rounded p-2 w-full @error('old_password') border-red-500 @enderror" required>

                            @error('old_password')
                            <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="password" class="@error('password') text-red-500 @enderror">{{ __('Password') }}</label>
                        <input id="password" type="password" class="border-gray-200 border rounded p-2 w-full @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="border-gray-200 border rounded p-2 w-full" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <button type="submit" class="rounded px-6 py-4 bg-secondary-500 text-white inline-block">Change password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
