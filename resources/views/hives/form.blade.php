<div class="field">
    <label for="name">Name</label>
    <div class="control">
        <input type="text" name="name" class="border-gray-200 border rounded p-2" value="{{ $hive->name }}">
    </div>
</div>

<div class="field">
    <label for="location">Location</label>
    <div class="control">
        <input type="text" name="location" class="border-gray-200 border rounded p-2" value="{{ $hive->location }}">
    </div>
</div>

<div class="field">
    <label for="apiary_id">Apiary</label>
    <div class="control">
        <select name="apiary_id">
            @foreach (Auth::user()->accessibleApiaries() as $apiary)
                <option value="{{ $apiary->id }}">{{ $apiary->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="control">
    <button type="submit">{{ $buttonText }}</button>
</div>
