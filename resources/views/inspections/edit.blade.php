@extends('layouts.app')

@section('pageTitle', 'Edit inspection: ' . $inspection->hive->name . ' ' . $inspection->date)

@section('content')
    <form action="{{ $inspection->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('inspections.form', ['buttonText' => 'Edit inspection'])
    </form>
@endsection
