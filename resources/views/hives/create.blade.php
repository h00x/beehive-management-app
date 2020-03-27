@extends('layouts.app')

@section('pageTitle', 'My Hives')

@section('content')
    <form action="{{ route('hives.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('hives.form', [
            'buttonText' => __('hives.create'),
            'hive' => new \App\Hive,
            'title' => __('hives.create')
         ])
    </form>
@endsection
