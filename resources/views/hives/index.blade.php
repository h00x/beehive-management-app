@extends('layouts.app')

@section('pageTitle', 'My Hives')

@section('subHeaders')
    @include('hives.subheader')
@stop

@section('actions')
    @include('layouts.button', ['text' => 'Create hive', 'url' => route('hives.create')])
@stop

@section('content')
    <div class="lg:flex lg:flex-wrap -mx-4">
        @foreach ($hives as $hive)
            <div class="lg:w-1/3 px-4 my-4">
                    <div class="shadow rounded-lg p-6 bg-white h-full relative hover-trigger">
                        <a href="{{ $hive->path() }}" class="absolute w-full h-full top-0 bottom-0 left-0 right-0 z-10"></a>
                        <div class="w-auto h-32 bg-gray-900 absolute top-0 left-0 right-0 rounded-t-lg opacity-75 hover-target">
                            <a href="#" class="absolute right-0 top-0 mr-5 text-2xl text-white">...</a>
                        </div>
                        <div class="w-auto h-32 bg-no-repeat bg-cover bg-center -mx-6 -mt-6 mb-6 rounded-t-lg" style="background-image: url('{{ Storage::url($hive->image) }}')"></div>
                        <p class="text-2xl font-title text-gray-900 block">{{ $hive->name }}</p>
                        Location: {{ $hive->apiary->location }}
                    </div>
            </div>
        @endforeach
    </div>
@endsection
