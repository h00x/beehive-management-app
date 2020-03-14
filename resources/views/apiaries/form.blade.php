@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="name">Name</label>
        <div class="control">
            <input type="text" name="name" class="border-gray-200 border rounded p-2 w-full" value="{{ old('name', $apiary->name) }}">
        </div>
    </div>

    <div class="field">
        <label for="location">Location</label>
        <div class="control">
            <input type="text" name="location" class="border-gray-200 border rounded p-2 w-full" value="{{ old('location', $apiary->location) }}">
        </div>
    </div>

    <div class="field">
        <label for="apiary_image">Apiary image</label>
        <div class="control">
            <input type="file" accept="image/*" name="apiary_image" class="border-gray-200 border rounded p-2 w-full">
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
