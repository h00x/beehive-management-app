@extends('layouts.app')

@section('pageTitle', 'My Apiaries')

@section('content')
    <div class="text-right">
        @include('layouts.button', ['text' => 'Create apiary', 'url' => route('apiaries.create')])
    </div>

    <div class="lg:flex lg:flex-wrap -mx-4">
        @foreach ($apiaries as $apiary)
            <div class="lg:w-1/3 px-4 my-4">
                <div class="shadow rounded p-6 bg-white h-full relative">
                    <a href="#" class="absolute right-0 top-0 mr-5 mt-2">...</a>
                    <img src="{{ Storage::url($apiary->image) }}" alt="{{ $apiary->name }}" class="w-auto">
                    <a href="{{ $apiary->path() }}" class="text-2xl font-title text-gray-900 block">Name: {{ $apiary->name }}</a>
                    Location: {{ $apiary->location }}
                </div>
            </div>
        @endforeach
    </div>
@endsection
