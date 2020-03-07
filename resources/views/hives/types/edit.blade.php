@extends('layouts.app')

@section('pageTitle', 'Hive Type: ' . $type->name)

@section('content')
    <form action="{{ $type->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('hives.types.form', ['buttonText' => 'Edit hive type', 'title' => 'Edit hive type'])
    </form>
@endsection
