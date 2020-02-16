@extends('layouts.app')

@section('pageTitle', 'Edit apiary: ' . $apiary->name)

@section('content')
    <form action="{{ $apiary->path() }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('apiaries.form', ['buttonText' => 'Edit apiary'])
    </form>

    @include('partials.errors')
@endsection
