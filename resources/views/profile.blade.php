@extends('layouts.app')

@section('pageTitle', 'Profile of ' . $user->name)

@section('content')
    Hi, {{ $user->name }} {{ $user->language }}

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <div>
            <label for="language">Language</label>
            <select name="language" id="language">
                <option value="en" {{ $user->language === 'en' ? 'selected' : '' }}>English</option>
                <option value="nl" {{ $user->language === 'nl' ? 'selected' : '' }}>Dutch</option>
            </select>
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection
