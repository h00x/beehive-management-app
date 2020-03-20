@extends('layouts.app')

@section('pageTitle', 'Login')

@section('content')
    <div class="form-content flex -mx-4 justify-center">
        <div class="w-1/2 px-4 my-4">
            <div class="shadow rounded-lg p-6 bg-white h-full relative hover-trigger">
                @if ($errors->any())
                    <flash-message :message="{{ json_encode(['description' => 'Please check the form below for errors', 'type' => 'danger']) }}"></flash-message>
                @endif

                <h2 class="text-3xl">Login to your account</h2>
                <p>Don't have an account yet? <a href="{{route('register')}}">Register here</a></p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label for="email" class="@error('email') text-red-500 @enderror">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="border-gray-200 border rounded p-2 w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password" class="@error('password') text-red-500 @enderror">{{ __('Password') }}</label>
                        <input id="password" type="password" class="border-gray-200 border rounded p-2 w-full @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="field">
                        <button type="submit" class="rounded px-6 py-4 mt-4 bg-secondary-500 text-white inline-block">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link ml-4" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
