@extends('layouts.app')

@section('pageTitle', 'Apiary: ' . $apiary->name)

@section('overviewUrl', route('apiaries.index'))

@section('actions')
    <div class="mr-4">
        <a href="{{ $apiary->path() }}" onclick="event.preventDefault();
                document.getElementById('delete-apiary').submit();" class="block warning">Delete apiary</a>

        <form id="delete-apiary" action="{{ $apiary->path() }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

    @include('layouts.button', ['text' => 'Edit apiary', 'url' => $apiary->path() . '/edit'])
@stop


@section('content')
    @if($apiary->image)
        <div class="w-auto h-48 bg-no-repeat bg-cover bg-center mb-12" style="background-image: url('{{ Storage::url($apiary->image) }}')"></div>
    @endif
    Location: {{ $apiary->location }}
@endsection
