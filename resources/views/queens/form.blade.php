@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="name" class="@error('name') text-red-500 @enderror">Queen name</label>
        <div class="control">
            <input type="text" name="name" class="border-gray-200 border rounded p-2 w-full @error('name') border-red-500 @enderror" value="{{ old('name', $queen->name) }}" required autofocus>

            @error('name')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="race" class="@error('race') text-red-500 @enderror">Queen race</label>
        <div class="control">
            <input type="text" name="race" class="border-gray-200 border rounded p-2 w-full @error('race') border-red-500 @enderror" value="{{ old('race', $queen->race) }}" required>

            @error('race')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="marking" class="@error('marking') text-red-500 @enderror">Queen marking</label>
        <div class="control">
            <input type="text" name="marking" class="border-gray-200 border rounded p-2 w-full @error('marking') border-red-500 @enderror" value="{{ old('marking', $queen->marking) }}" required>

            @error('marking')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
