@extends('layouts.app')

@section('pageTitle', 'Inspection: ' . $inspection->hive->name . ' ' . $inspection->date)

@section('content')
    <form action="{{ $inspection->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('inspections.form', ['buttonText' => 'Edit inspection', 'title' => 'Edit inspection'])
    </form>
@endsection
