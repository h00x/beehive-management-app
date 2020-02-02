@extends('layouts.app')

@section('pageTitle', 'Edit apiary: ' . $apiary->name)

@section('content')
    <form action="{{ $apiary->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('apiaries.form', ['buttonText' => 'Edit apiary'])
    </form>
@endsection
