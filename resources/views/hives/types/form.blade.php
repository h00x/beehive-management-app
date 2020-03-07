@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="name">Hive type name</label>
        <div class="control">
            <input type="text" name="name" class="border-gray-200 border rounded p-2" value="{{ old('name', $type->name) }}">
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
