@extends('layouts.app')

@section('pageTitle', 'Apiary: ' . $apiary->name)

@section('content')
    <form action="{{ $apiary->path() }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('apiaries.form', ['buttonText' => 'Edit apiary', 'title' => 'Edit apiary'])
    </form>

    @include('partials.errors')
@endsection
