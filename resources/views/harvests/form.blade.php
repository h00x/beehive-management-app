@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="name">Harvest name</label>
        <div class="control">
            <input type="text" name="name" class="border-gray-200 border rounded p-2 w-full" value="{{ old('name', $harvest->name) }}">
        </div>
    </div>

    <div class="field">
        <label for="name">Hive's</label>
        <div class="control">
            @if (Auth::user()->hives->isNotEmpty())
                <select name="hive_id[]" class="w-full" multiple>
                    @foreach (Auth::user()->hives as $hive)
                        <option value="{{ $hive->id }}" {{ $harvest->hasHive($hive) ? 'selected' : '' }}>{{ $hive->name }}</option>
                    @endforeach
                </select>
            @else
                <a href="{{ route('hives.create') }}">Create a hive</a>
            @endif
        </div>
    </div>

    <div class="field">
        <label for="date">Harvest date</label>
        <div class="control">
            <input type="date" name="date" class="border-gray-200 border rounded p-2 w-full" value="{{ old('date') ?? parseDateForInput($harvest->date, 'Y-m-d') ?? dateNowForInput('Y-m-d') }}">
        </div>
    </div>

    <div class="field">
        <label for="batch_code">Batch code</label>
        <div class="control">
            <input type="text" name="batch_code" class="border-gray-200 border rounded p-2 w-full" value="{{ old('batch_code', $harvest->batch_code) }}">
        </div>
    </div>

    <div class="field">
        <label for="weight">Weight</label>
        <div class="control">
            <input type="number" name="weight" class="border-gray-200 border rounded p-2 w-full" value="{{ old('weight', $harvest->weight) }}" min="0" max="100000">
        </div>
    </div>

    <div class="field">
        <label for="moister_content">Moister content</label>
        <div class="control">
            <input type="number" name="moister_content" class="border-gray-200 border rounded p-2 w-full" value="{{ old('moister_content', $harvest->moister_content) }}" min="0" max="100">
        </div>
    </div>

    <div class="field">
        <label for="nectar_source">Nectar source</label>
        <div class="control">
            <input type="text" name="nectar_source" class="border-gray-200 border rounded p-2 w-full" value="{{ old('nectar_source', $harvest->nectar_source) }}">
        </div>
    </div>

    <div class="field">
        <label for="description">Description</label>
        <div class="control">
            <textarea name="description" cols="30" rows="10" class="border-gray-200 border rounded p-2 w-full">{{ old('description', $harvest->description) }}</textarea>
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
