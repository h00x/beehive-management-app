<div class="field">
    <label for="name">Harvest name</label>
    <div class="control">
        <input type="text" name="name" class="border-gray-200 border rounded p-2" value="{{ $harvest->name }}">
    </div>
</div>

<div class="field">
    <label for="name">Hive's</label>
    <div class="control">
        @if (Auth::user()->hives->isNotEmpty())
            <select name="hive_id[]" multiple>
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
        <input type="date" name="date" class="border-gray-200 border rounded p-2" value="{{ Carbon\Carbon::parse($harvest->date)->format('Y-m-d') ?? Carbon\Carbon::now()->format('Y-m-d') }}">
    </div>
</div>

<div class="field">
    <label for="batch_code">Batch code</label>
    <div class="control">
        <input type="text" name="batch_code" class="border-gray-200 border rounded p-2" value="{{ $harvest->batch_code }}">
    </div>
</div>

<div class="field">
    <label for="weight">Weight</label>
    <div class="control">
        <input type="number" name="weight" class="border-gray-200 border rounded p-2" value="{{ $harvest->weight }}">
    </div>
</div>

<div class="field">
    <label for="moister_content">Moister content</label>
    <div class="control">
        <input type="number" name="moister_content" class="border-gray-200 border rounded p-2" value="{{ $harvest->moister_content }}">
    </div>
</div>

<div class="field">
    <label for="nectar_source">Nectar source</label>
    <div class="control">
        <input type="text" name="nectar_source" class="border-gray-200 border rounded p-2" value="{{ $harvest->nectar_source }}">
    </div>
</div>

<div class="field">
    <label for="description">Description</label>
    <div class="control">
        <textarea name="description" cols="30" rows="10" class="border-gray-200 border rounded p-2">{{ $harvest->description }}</textarea>
    </div>
</div>

<div class="control">
    <button type="submit">{{ $buttonText }}</button>
</div>
