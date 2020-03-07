@extends('layouts.app')

@section('pageTitle', 'My Inspections')

@section('content')
    <form action="{{ route('inspections.store') }}" method="POST">
        @csrf
        @include('inspections.form', ['buttonText' => 'Create inspection', 'inspection' => new \App\Inspection, 'title' => 'Log inspection'])
    </form>

    @include('partials.errors')
@endsection
