@extends('layouts.app')

@section('pageTitle', 'Hive: ' . $hive->name)

@section('content')
    <form action="{{ $hive->path() }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('hives.form', ['buttonText' => 'Edit hive', 'title' => 'Edit hive'])
    </form>
@endsection
