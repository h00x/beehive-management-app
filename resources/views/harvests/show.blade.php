@extends('layouts.app')

@section('pageTitle', 'Harvest: ' . $harvest->name)

@section('content')
    @include('layouts.button', ['text' => 'Edit harvest', 'url' => $harvest->path() . '/edit'])

    <a href="{{ $harvest->path() }}" onclick="event.preventDefault();
                   document.getElementById('delete-harvest').submit();" class="block text-red-500">Delete harvest</a>

    <form id="delete-harvest" action="{{ $harvest->path() }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <p>Name: {{ $harvest->name }}</p>
    <p>Hives:
        @foreach($harvest->hives as $hive)
            {{ $hive->name . ', ' }}
        @endforeach
    </p>
    <p>Date: {{ $harvest->date }}</p>
    <p>Batch code: {{ $harvest->batch_code }}</p>
    <p>Weight: {{ $harvest->weight }}</p>
    <p>Moister content: {{ $harvest->moister_content }}</p>
    <p>Nectar source: {{ $harvest->nectar_source }}</p>
    <p>Description: {{ $harvest->description }}</p>
@endsection
