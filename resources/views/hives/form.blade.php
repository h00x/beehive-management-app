@extends('partials.form-layout')

@section('title', $title)

@section('form')
    <div class="field">
        <label for="name" class="@error('name') text-red-500 @enderror">@lang('hives.name')</label>
        <div class="control">
            <input type="text" name="name" class="border-gray-200 border rounded p-2 w-full @error('name') border-red-500 @enderror" value="{{ old('name', $hive->name) }}" required autofocus>

            @error('name')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="beehive_image" class="@error('beehive_image') text-red-500 @enderror">@lang('hives.image')</label>
        <div class="control">
            <input type="file" accept="image/*" name="beehive_image" class="border-gray-200 border rounded p-2 w-full @error('beehive_image') border-red-500 @enderror">

            @error('beehive_image')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="apiary_id" class="@error('apiary_id') text-red-500 @enderror">{{ trans_choice('apiaries.apiary', 1) }}</label>
        <div class="control">
            @if (Auth::user()->apiaries->isNotEmpty())
                <select name="apiary_id" class="w-full @error('apiary_id') border-red-500 @enderror" required>
                    @foreach (Auth::user()->apiaries as $apiary)
                        <option value="{{ $apiary->id }}" {{ checkIdForSelected($apiary->id, $hive->apiary_id, intval(old('apiary_id'))) }}>{{ $apiary->name }}</option>
                    @endforeach
                </select>
            @endif

            @error('apiary_id')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror

            <a href="{{ route('apiaries.create') }}" class="block">@lang('apiaries.create')</a>
        </div>
    </div>

    <div class="field">
        <label for="hive_type_id" class="@error('hive_type_id') text-red-500 @enderror">{{ trans_choice('hivetypes.type', 1) }}</label>
        <div class="control">
            <select name="hive_type_id" class="w-full @error('hive_type_id') border-red-500 @enderror" required>
                @foreach (Auth::user()->hiveTypes as $hiveType)
                    <option value="{{ $hiveType->id }}" {{ checkIdForSelected($hiveType->id, $hive->type_id, intval(old('hive_type_id'))) }}>{{ $hiveType->name }}</option>
                @endforeach
            </select>

            @error('hive_type_id')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror

            <a href="{{ route('types.create') }}" class="block">@lang('hivetypes.create')</a>
        </div>
    </div>

    <div class="field">
        <label for="queen_id" class="@error('queen_id') text-red-500 @enderror">{{ trans_choice('queens.queen', 1) }}</label>
        <div class="control">
            @if (Auth::user()->availableQueens()->count() || $hive->queen)
                <select name="queen_id" class="w-full @error('queen_id') border-red-500 @enderror" required>
                    @foreach (Auth::user()->queens as $queen)
                        @if (!$queen->hasAHive() || $queen->is($hive->queen))
                            <option value="{{ $queen->id }}" {{ checkIdForSelected($queen->id, $hive->queen_id, intval(old('queen_id'))) }}>{{ $queen->name }}</option>
                        @endif
                    @endforeach
                </select>
            @endif
            @error('queen_id')
                <span class="text-sm text-red-500" role="alert">{{ $message }}</span>
            @enderror
            <a href="{{ route('queens.create') }}" class="block">@lang('queens.create')</a>
        </div>
    </div>
@stop

@section('button')
    {{ $buttonText }}
@stop
