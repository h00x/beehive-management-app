@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="name" class="@error('name') text-red-500 @enderror">Name</label>
        <div class="control">
            <input type="text" name="name" class="border-gray-200 border rounded p-2 w-full @error('name') border-red-500 @enderror" value="{{ old('name', $apiary->name) }}" required autofocus>

            @error('name')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="location" class="@error('location') text-red-500 @enderror">Location</label>
        <div class="control">
            <input type="text" name="location" class="border-gray-200 border rounded p-2 w-full @error('location') border-red-500 @enderror" value="{{ old('location', $apiary->location) }}" required>

            @error('location')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="apiary_image" class="@error('apiary_image') text-red-500 @enderror">Apiary image</label>
        <div class="control">
            <input type="file" accept="image/*" name="apiary_image" class="border-gray-200 border rounded p-2 w-full @error('apiary_image') border-red-500 @enderror">

            @error('apiary_image')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
