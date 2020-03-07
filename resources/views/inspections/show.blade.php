@extends('layouts.app')

@section('pageTitle', 'Inspection: ' . $inspection->hive->name . ' ' . $inspection->date)

@section('actions')
    <div class="mr-4">
        <a href="{{ $inspection->path() }}" onclick="event.preventDefault();
            document.getElementById('delete-inspection').submit();" class="block text-red-500">Delete harvest</a>

        <form id="delete-inspection" action="{{ $inspection->path() }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')

        </form>
    </div>

    @include('layouts.button', ['text' => 'Edit inspection', 'url' => $inspection->path() . '/edit'])
@stop

@section('content')

    <p>Date: {{ $inspection->date }}</p>
    <p>Hive: <a href="{{ $inspection->hive->path() }}">{{ $inspection->hive->name }}</a></p>
    <p>Queen seen: {{ $inspection->queen_seen }}</p>
    <p>Larval seen: {{ $inspection->larval_seen }}</p>
    <p>Young larval seen: {{ $inspection->young_larval_seen }}</p>
    <p>Pollen arriving: {{ $inspection->pollen_arriving }}</p>
    <p>Comb building: {{ $inspection->comb_building }}</p>
    <p>Notes: {{ $inspection->notes }}</p>
    <p>Weather: {{ $inspection->weather }}</p>
    <p>Temperature: {{ $inspection->temperature }}</p>
@endsection
