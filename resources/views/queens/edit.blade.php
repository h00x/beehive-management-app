@extends('layouts.app')

@section('pageTitle', 'Queen: ' . $queen->name)

@section('content')
    <form action="{{ $queen->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('queens.form', ['buttonText' => 'Edit queen', 'title' => 'Edit queen'])
    </form>

    @include('partials.errors')
@endsection
