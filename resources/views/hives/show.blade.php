@extends('layouts.app')

@section('pageTitle', 'Hive: ' . $hive->name)

@section('content')
    Location: {{ $hive->location }}
@endsection
