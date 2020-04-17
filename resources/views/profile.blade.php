@extends('layouts.app')

@section('pageTitle', 'Profile of ' . $user->first_name)

@section('content')
    <div class="form-content flex -mx-4 justify-center">
        <div class="w-1/2 px-4 my-4">
            <div class="shadow rounded-lg p-6 bg-white h-full relative">
                <h2 class="text-3xl mb-4">Hi, {{ $user->first_name }}</h2>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="field">
                        <label for="first_name" class="@error('first_name') text-red-500 @enderror">First name</label>
                        <div class="control">
                            <input type="text" name="first_name" id="first_name" class="border-gray-200 border rounded p-2 w-full @error('first_name') border-red-500 @enderror" value="{{ old('first_name', $user->first_name) }}" required>

                            @error('first_name')
                                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="last_name" class="@error('last_name') text-red-500 @enderror">Last name</label>
                        <div class="control">
                            <input type="text" name="last_name" id="last_name" class="border-gray-200 border rounded p-2 w-full @error('last_name') border-red-500 @enderror" value="{{ old('last_name', $user->last_name) }}">

                            @error('last_name')
                                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <div class="control">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="field">
                        <label for="language">Language</label>
                        <div class="control">
                            <select name="language" id="language" class="w-full">
                                <option value="en" {{ $user->language === 'en' ? 'selected' : '' }}>English</option>
                                <option value="nl" {{ $user->language === 'nl' ? 'selected' : '' }}>Dutch</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <button type="submit" class="rounded px-6 py-4 bg-secondary-500 text-white inline-block">Change profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
