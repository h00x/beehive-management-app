@extends('layouts.app')

@section('pageTitle', 'Create an Apiary')

@section('content')
    Start creating an apiary here
    <form action="{{ route('apiaries.store') }}" method="POST">
        @csrf
        @include('apiaries.form', ['buttonText' => 'Create Apiary', 'apiary' => new \App\Apiary])
    </form>

    @include('partials.errors')
@endsection
