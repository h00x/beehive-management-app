@extends('layouts.app')

@section('pageTitle', 'My Queens')

@section('content')
    <form action="{{ route('queens.store') }}" method="POST">
        @csrf
        @include('queens.form', ['buttonText' => 'Create a queen', 'queen' => new \App\Queen, 'title' => 'Create queen'])
    </form>
@endsection
