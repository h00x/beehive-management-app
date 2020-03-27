@extends('layouts.app')

@section('pageTitle', trans_choice('hives.hive', 1) . ': ' . $hive->name)

@section('content')
    <form action="{{ $hive->path() }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('hives.form', ['buttonText' => __('hives.edit'), 'title' => __('hives.edit')])
    </form>
@endsection
