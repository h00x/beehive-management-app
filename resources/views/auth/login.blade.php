@extends('layouts.app')

@section('pageTitle', 'Login')

@section('content')
    <div class="form-content flex -mx-4 justify-center">
        <div class="w-1/2 px-4 my-4">
            <div class="shadow rounded-lg p-6 bg-white h-full relative hover-trigger">
                <h2 class="text-3xl">Login to your account</h2>
                <p>Don't have an account yet? <a href="{{route('register')}}">Register here</a></p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="border-gray-200 border rounded p-2 w-full" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="border-gray-200 border rounded p-2 w-full" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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
