@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="name">Queen name</label>
        <div class="control">
            <input type="text" name="name" class="border-gray-200 border rounded p-2" value="{{ old('name', $queen->name) }}">
        </div>
    </div>

    <div class="field">
        <label for="race">Queen race</label>
        <div class="control">
            <input type="text" name="race" class="border-gray-200 border rounded p-2" value="{{ old('race', $queen->race) }}">
        </div>
    </div>

    <div class="field">
        <label for="marking">Queen marking</label>
        <div class="control">
            <input type="text" name="marking" class="border-gray-200 border rounded p-2" value="{{ old('marking', $queen->marking) }}">
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
