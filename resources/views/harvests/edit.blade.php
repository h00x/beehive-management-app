@extends('layouts.app')

@section('pageTitle', 'Harvest: ' . $harvest->name)

@section('content')
    <form action="{{ $harvest->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('harvests.form', ['buttonText' => 'Edit harvest', 'title' => 'Edit harvest'])
    </form>

    @include('partials.errors')
@endsection
