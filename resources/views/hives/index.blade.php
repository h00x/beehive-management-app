@extends('layouts.app')

@section('pageTitle', 'My Hives')

@section('subHeaders')
    @include('hives.subheader')
@stop

@section('content')
    @include('layouts.button', ['text' => 'Create hive', 'url' => route('hives.create')])

    <div class="lg:flex lg:flex-wrap -mx-4">
        @foreach ($hives as $hive)
            <div class="lg:w-1/3 px-4 my-4">
                <div class="shadow rounded p-6 bg-white h-full relative">
                    <a href="#" class="absolute right-0 top-0 mr-5 mt-2">...</a>
                    <img src="{{ Storage::url($hive->image) }}" alt="{{ $hive->name }}" class="w-auto">
                    <a href="{{ $hive->path() }}" class="text-2xl font-title text-gray-900 block">Name: {{ $hive->name }}</a>
                    Location: {{ $hive->apiary->location }}
                </div>
            </div>
        @endforeach
    </div>
@endsection
