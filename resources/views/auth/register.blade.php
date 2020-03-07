@extends('layouts.app')

@section('pageTitle', 'Register')

@section('content')
    <div class="form-content flex -mx-4 justify-center">
        <div class="w-1/2 px-4 my-4">
            <div class="shadow rounded-lg p-6 bg-white h-full relative hover-trigger">
                <h2 class="text-3xl">Register an account</h2>
                <p>Already have an account? <a href="{{route('login')}}">Login here</a></p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="field">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="border-gray-200 border rounded p-2 w-full" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="border-gray-200 border rounded p-2 w-full" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="border-gray-200 border rounded p-2 w-full" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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
