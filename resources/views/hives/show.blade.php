@extends('layouts.app')

@section('pageTitle', 'Hive: ' . $hive->name)

@section('content')
    @include('layouts.button', ['text' => 'Edit hive', 'url' => $hive->path() . '/edit'])

    <a href="{{ $hive->path() }}" onclick="event.preventDefault();
                   document.getElementById('delete-hive').submit();" class="block">Delete hive</a>

    <form id="delete-hive" action="{{ $hive->path() }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <p>Location: {{ $hive->apiary->location }}</p>
    <p>Apiary: <a href="{{ $hive->apiary->path() }}">{{ $hive->apiary->name }}</a></p>
@endsection
