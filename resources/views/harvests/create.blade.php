@extends('layouts.app')

@section('pageTitle', 'My Harvests')

@section('content')
    <form action="{{ route('harvests.store') }}" method="POST">
        @csrf
        @include('harvests.form', ['buttonText' => 'Create harvest', 'harvest' => new \App\Harvest, 'title' => 'Create harvest'])
    </form>
@endsection
