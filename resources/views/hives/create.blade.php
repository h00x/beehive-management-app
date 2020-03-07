@extends('layouts.app')

@section('pageTitle', 'My Hives')

@section('content')
    <form action="{{ route('hives.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('hives.form', [
            'buttonText' => 'Create hive',
            'hive' => new \App\Hive,
            'title' => 'Create a hive'
         ])
    </form>

    @include('partials.errors')
@endsection
