@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="date" class="@error('date') text-red-500 @enderror">Inspection date</label>
        <div class="control">
            <input type="datetime-local" name="date" class="border-gray-200 border rounded p-2 w-full @error('date') border-red-500 @enderror" value="{{ old('date') ?? parseDateForInput($inspection->date) ?? dateNowForInput() }}" required>

            @error('date')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="hive_id" class="@error('hive_id') text-red-500 @enderror">Hive</label>
        <div class="control">
            @if (Auth::user()->hives->isNotEmpty())
                <select name="hive_id" class="w-full @error('hive_id') border-red-500 @enderror" required>
                    @foreach (Auth::user()->hives as $hive)
                        <option value="{{ $hive->id }}" {{ checkIdForSelected($hive->id, $inspection->hive_id, intval(old('hive_id'))) }}>{{ $hive->name }}</option>
                    @endforeach
                </select>
            @else
                <a href="{{ route('hives.create') }}">Create a hive</a>
            @endif

            @error('hive_id')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <div class="control">
            <input type="checkbox" name="queen_seen" value="1" {{ $inspection->queen_seen || old('queen_seen') ? 'checked' : '' }}>
            <label for="queen_seen" class="@error('queen_seen') text-red-500 @enderror">Queen seen</label>
            @error('queen_seen')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <div class="control">
            <input type="checkbox" name="larval_seen" value="1" {{ $inspection->larval_seen || old('larval_seen') ? 'checked' : '' }}>
            <label for="larval_seen" class="@error('larval_seen') text-red-500 @enderror">Larval seen</label>
            @error('larval_seen')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <div class="control">
            <input type="checkbox" name="young_larval_seen" value="1" {{ $inspection->young_larval_seen || old('young_larval_seen') ? 'checked' : '' }}>
            <label for="young_larval_seen" class="@error('young_larval_seen') text-red-500 @enderror">Young larval seen</label>
            @error('young_larval_seen')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="pollen_arriving" class="@error('pollen_arriving') text-red-500 @enderror">Pollen arriving</label>
        <div class="control">
            <input type="number" name="pollen_arriving" class="border-gray-200 border rounded p-2 w-full @error('pollen_arriving') border-red-500 @enderror" value="{{ old('pollen_arriving', $inspection->pollen_arriving) }}" min="0" max="100" required>

            @error('pollen_arriving')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="comb_building" class="@error('comb_building') text-red-500 @enderror">Comb building</label>
        <div class="control">
            <input type="number" name="comb_building" class="border-gray-200 border rounded p-2 w-full @error('comb_building') border-red-500 @enderror" value="{{ old('comb_building', $inspection->comb_building) }}" min="0" max="100" required>

            @error('comb_building')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="notes" class="@error('notes') text-red-500 @enderror">Notes</label>
        <div class="control">
            <textarea name="notes" cols="30" rows="10" class="border-gray-200 border rounded p-2 w-full @error('notes') border-red-500 @enderror">
                {{ old('notes', $inspection->notes) }}
            </textarea>

            @error('notes')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
