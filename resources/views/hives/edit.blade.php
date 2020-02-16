@extends('layouts.app')

@section('pageTitle', 'Edit hive: ' . $hive->name)

@section('content')
    <form action="{{ $hive->path() }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('hives.form', ['buttonText' => 'Edit hive'])
    </form>

    @include('partials.errors')
@endsection
