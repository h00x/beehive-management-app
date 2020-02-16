@extends('layouts.app')

@section('pageTitle', 'Edit queen: ' . $queen->name)

@section('content')
    <form action="{{ $queen->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('queens.form', ['buttonText' => 'Edit queen'])
    </form>

    @include('partials.errors')
@endsection
