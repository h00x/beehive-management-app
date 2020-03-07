@extends('layouts.app')

@section('pageTitle', 'Apiary: ' . $apiary->name)

@section('actions')
    <div class="mr-4">
        <a href="{{ $apiary->path() }}" onclick="event.preventDefault();
                document.getElementById('delete-apiary').submit();" class="block text-red-500">Delete apiary</a>

        <form id="delete-apiary" action="{{ $apiary->path() }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

    @include('layouts.button', ['text' => 'Edit apiary', 'url' => $apiary->path() . '/edit'])
@stop


@section('content')
    <div class="w-auto h-48 bg-no-repeat bg-cover bg-center mb-12" style="background-image: url('{{ Storage::url($apiary->image) }}')"></div>
    Location: {{ $apiary->location }}
@endsection
