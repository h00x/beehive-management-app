@extends('layouts.app')

@section('pageTitle', 'My Hives')

@section('content')
    @include('layouts.button', ['text' => 'Create hive', 'url' => route('hives.create')])

    @foreach ($hives as $hive)
        <div class="shadow rounded p-6 bg-white">
            <h2 class="text-2xl font-title text-gray-900">Name: {{ $hive->name }}</h2>
            Location: {{ $hive->location }}
        </div>
    @endforeach
@endsection
