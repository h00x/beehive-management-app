@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="name" class="@error('name') text-red-500 @enderror">Hive type name</label>
        <div class="control">
            <input type="text" name="name" class="border-gray-200 border rounded p-2 w-full @error('name') border-red-500 @enderror" value="{{ old('name', $type->name) }}" required autofocus>

            @error('name')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
