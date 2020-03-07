@extends('layouts.app')

@section('pageTitle', 'My Hive Types')

@section('content')
    <form action="{{ route('types.store') }}" method="POST">
        @csrf
        @include('hives.types.form', ['buttonText' => 'Create hive type', 'type' => new \App\HiveType, 'title' => 'Create hive type'])
    </form>

    @include('partials.errors')
@endsection
