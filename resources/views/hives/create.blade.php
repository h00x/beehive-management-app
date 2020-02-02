@extends('layouts.app')

@section('pageTitle', 'Create a hive')

@section('content')
    Start creating a hive here
    <form action="{{ route('hives.store') }}" method="POST">
        @csrf
        @include('hives.form', ['buttonText' => 'Create hive', 'hive' => new \App\Hive])
    </form>

    @include('partials.errors')
@endsection
