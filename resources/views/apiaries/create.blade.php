@extends('layouts.app')

@section('pageTitle', 'My Apiaries')

@section('content')
    <form action="{{ route('apiaries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('apiaries.form', ['buttonText' => 'Create Apiary', 'apiary' => new \App\Apiary, 'title' => 'Create apiary'])
    </form>
@endsection
