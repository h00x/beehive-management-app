<div class="field">
    <label for="name">Name</label>
    <div class="control">
        <input type="text" name="name" class="border-gray-200 border rounded p-2" value="{{ old('name', $apiary->name) }}">
    </div>
</div>

<div class="field">
    <label for="location">Location</label>
    <div class="control">
        <input type="text" name="location" class="border-gray-200 border rounded p-2" value="{{ old('location', $apiary->location) }}">
    </div>
</div>

<div class="control">
    <button type="submit">{{ $buttonText }}</button>
</div>
