@extends('layouts.app')

@section('pageTitle', 'Harvest: ' . $harvest->name)

@section('overviewUrl', route('harvests.index'))

@section('headerButton')
    @include('layouts.button', ['text' => 'Edit harvest', 'url' => $harvest->path() . '/edit'])
@endsection

@section('deleteLink')
    <div class="mr-4">
        <a href="{{ $harvest->path() }}" onclick="event.preventDefault();
            document.getElementById('delete-harvest').submit();" class="block warning">Delete harvest</a>

        <form id="delete-harvest" action="{{ $harvest->path() }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
@stop

@section('content')

    <p>Name: {{ $harvest->name }}</p>
    <p>Hives:
        @foreach($harvest->hives as $hive)
            <a href="{{ $hive->path() }}">{{ $hive->name }}</a>,
        @endforeach
    </p>
    <p>Date: {{ $harvest->date }}</p>
    <p>Batch code: {{ $harvest->batch_code }}</p>
    <p>Weight: {{ $harvest->weight }}</p>
    <p>Moister content: {{ $harvest->moister_content }}</p>
    <p>Nectar source: {{ $harvest->nectar_source }}</p>
    <p>Description: {{ $harvest->description }}</p>
@endsection
