@extends('layouts.app')

@section('pageTitle', 'Register')

@section('content')
    <div class="form-content flex -mx-4 justify-center">
        <div class="w-1/2 px-4 my-4">
            <div class="shadow rounded-lg p-6 bg-white h-full relative hover-trigger">
                @if ($errors->any())
                    <flash-message :message="{{ json_encode(['description' => 'Please check the form below for errors', 'type' => 'danger']) }}"></flash-message>
                @endif

                <h2 class="text-3xl">Register an account</h2>
                <p>Already have an account? <a href="{{route('login')}}">Login here</a></p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="field">
                        <label for="first_name" class="@error('first_name') text-red-500 @enderror">{{ __('First name') }}</label>
                        <input id="first_name" type="text" class="border-gray-200 border rounded p-2 w-full @error('first_name') border-red-500 @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                        @error('first_name')
                            <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="last_name" class="@error('last_name') text-red-500 @enderror">{{ __('Last name') }}</label>
                        <input id="last_name" type="text" class="border-gray-200 border rounded p-2 w-full @error('last_name') border-red-500 @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="first_name" autofocus>

                        @error('last_name')
                            <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email" class="@error('email') text-red-500 @enderror">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="border-gray-200 border rounded p-2 w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
                        @enderror
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

                    <div class="field">
                        <button type="submit" class="rounded px-6 py-4 mt-4 bg-secondary-500 text-white inline-block">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
