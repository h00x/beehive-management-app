@extends('layouts.app')

@section('pageTitle', 'Create a hive type')

@section('content')
    Start creating a hive here
    <form action="{{ route('types.store') }}" method="POST">
        @csrf
        @include('hives.types.form', ['buttonText' => 'Create hive type', 'type' => new \App\HiveType])
    </form>

    @include('partials.errors')
@endsection
