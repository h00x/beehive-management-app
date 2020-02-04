@extends('layouts.app')

@section('pageTitle', 'Edit hive type: ' . $type->name)

@section('content')
    <form action="{{ $type->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('hives.types.form', ['buttonText' => 'Edit hive type'])
    </form>
@endsection
