@extends('layouts.app')

@section('pageTitle', 'Apiary: ' . $apiary->name)

@section('content')
    @include('layouts.button', ['text' => 'Edit hive', 'url' => $apiary->path() . '/edit'])

    <a href="{{ $apiary->path() }}" onclick="event.preventDefault();
                   document.getElementById('delete-apiary').submit();" class="block text-red-500">Delete apiary</a>

    <form id="delete-apiary" action="{{ $apiary->path() }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <img src="{{ Storage::url($apiary->image) }}" alt="{{ $apiary->name }}" class="w-auto">
    Location: {{ $apiary->location }}
@endsection
