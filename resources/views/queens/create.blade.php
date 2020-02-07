@extends('layouts.app')

@section('pageTitle', 'Create a queen')

@section('content')
    Create a queen
    <form action="{{ route('queens.store') }}" method="POST">
        @csrf
        @include('queens.form', ['buttonText' => 'Create a queen', 'queen' => new \App\Queen])
    </form>

    @include('partials.errors')
@endsection
