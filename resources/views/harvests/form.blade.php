@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="name" class="@error('name') text-red-500 @enderror">Harvest name</label>
        <div class="control">
            <input type="text" name="name" class="border-gray-200 border rounded p-2 w-full @error('name') border-red-500 @enderror" value="{{ old('name', $harvest->name) }}" required autofocus>

            @error('name')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="hive_id[]" class="@error('hive_id') text-red-500 @enderror">Hive's</label>
        <div class="control">
            @if (Auth::user()->hives->isNotEmpty())
                <select name="hive_id[]" class="w-full @error('hive_id[]') border-red-500 @enderror" multiple required>
                    @foreach (Auth::user()->hives as $hive)
                        <option value="{{ $hive->id }}" {{ $harvest->hasHive($hive) || request()->hivePreviousPage == $hive->id ? 'selected' : '' }}>{{ $hive->name }}</option>
                    @endforeach
                </select>
            @else
                <a href="{{ route('hives.create') }}">Create a hive</a>
            @endif

            @error('hive_id[]')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="date" class="@error('date') text-red-500 @enderror">Harvest date</label>
        <div class="control">
            <input type="date" name="date" class="border-gray-200 border rounded p-2 w-full @error('date') border-red-500 @enderror" value="{{ old('date') ?? parseDateForInput($harvest->date, 'Y-m-d') ?? dateNowForInput('Y-m-d') }}" required>

            @error('date')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="batch_code" class="@error('batch_code') text-red-500 @enderror">Batch code</label>
        <div class="control">
            <input type="text" name="batch_code" class="border-gray-200 border rounded p-2 w-full @error('batch_code') border-red-500 @enderror" value="{{ old('batch_code', $harvest->batch_code) }}" required>

            @error('batch_code')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="weight" class="@error('weight') text-red-500 @enderror">Weight {{ auth()->user()->uses_metric ? 'in kg' : 'in lbs' }}</label>
        <div class="control">
            <input type="number" name="weight" class="border-gray-200 border rounded p-2 w-full @error('weight') border-red-500 @enderror" value="{{ round(old('weight', $harvest->converted_weight)) }}" min="0" max="{{ auth()->user()->uses_metric ? '100000' : '220462' }}" required>

            @error('weight')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="moister_content" class="@error('moister_content') text-red-500 @enderror">Moister content</label>
        <div class="control">
            <input type="number" name="moister_content" class="border-gray-200 border rounded p-2 w-full @error('moister_content') border-red-500 @enderror" value="{{ old('moister_content', $harvest->moister_content) }}" min="0" max="100" required>

            @error('moister_content')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="nectar_source" class="@error('nectar_source') text-red-500 @enderror">Nectar source</label>
        <div class="control">
            <input type="text" name="nectar_source" class="border-gray-200 border rounded p-2 w-full @error('nectar_source') border-red-500 @enderror" value="{{ old('nectar_source', $harvest->nectar_source) }}" required>

            @error('nectar_source')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="description" class="@error('description') text-red-500 @enderror">Description</label>
        <div class="control">
            <textarea name="description" cols="30" rows="10" class="border-gray-200 border rounded p-2 w-full @error('description') border-red-500 @enderror">{{ old('description', $harvest->description) }}</textarea>

            @error('description')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
