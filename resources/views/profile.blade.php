@extends('layouts.app')

@section('pageTitle', 'Profile of ' . $user->name)

@section('content')
    <div class="form-content flex -mx-4 justify-center">
        <div class="w-1/2 px-4 my-4">
            <div class="shadow rounded-lg p-6 bg-white h-full relative">
                <h2 class="text-3xl mb-4">Hi, {{ $user->name }}</h2>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="field">
                        <label for="name" class="@error('name') text-red-500 @enderror">Name</label>
                        <div class="control">
                            <input type="text" name="name" id="name" class="border-gray-200 border rounded p-2 w-full @error('name') border-red-500 @enderror" value="{{ old('name', $user->name) }}" required>

                            @error('name')
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
