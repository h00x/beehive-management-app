@extends('layouts.app')

@section('pageTitle', 'Log a Inspection')

@section('content')
    Start logging an inspection here
    <form action="{{ route('inspections.store') }}" method="POST">
        @csrf
        @include('inspections.form', ['buttonText' => 'Create inspection', 'inspection' => new \App\Inspection])
    </form>

    @include('partials.errors')
@endsection
