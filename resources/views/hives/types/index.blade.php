@extends('layouts.app')

@section('pageTitle', 'My Hives Types')

@section('content')
    @include('layouts.button', ['text' => 'Create a hive type', 'url' => route('types.create')])

    <div class="lg:flex lg:flex-wrap -mx-4">
        @foreach ($types as $type)
            <div class="lg:w-1/3 px-4 my-4">
                <div class="shadow rounded p-6 bg-white h-full relative">
                    <a href="#" class="absolute right-0 top-0 mr-5 mt-2">...</a>
                    <a href="{{ $type->path() }}" class="text-2xl font-title text-gray-900 block">Name: {{ $type->name }}</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
