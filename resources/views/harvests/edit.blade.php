@extends('layouts.app')

@section('pageTitle', 'Edit harvest: ' . $harvest->name)

@section('content')
    <form action="{{ $harvest->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('harvests.form', ['buttonText' => 'Edit harvest'])
    </form>
@endsection
