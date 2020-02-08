@extends('layouts.app')

@section('pageTitle', 'Log a Harvest')

@section('content')
    Start logging a harvest here
    <form action="{{ route('harvests.store') }}" method="POST">
        @csrf
        @include('harvests.form', ['buttonText' => 'Create harvest', 'harvest' => new \App\Harvest])
    </form>

    @include('partials.errors')
@endsection
