@extends('layouts.app')

@section('pageTitle', 'Create a hive')

@section('content')
    Start creating a hive here
    <form action="{{ route('hives.store') }}" method="POST">
        @csrf
        <div class="field">
            <label for="name">Name</label>
            <div class="control">
                <input type="text" name="name" class="border-gray-200 border rounded p-2">
            </div>
        </div>

        <div class="field">
            <label for="location">Location</label>
            <div class="control">
                <input type="text" name="location" class="border-gray-200 border rounded p-2">
            </div>
        </div>

        <div class="control">
            <button type="submit">Submit</button>
        </div>
    </form>
@endsection
