<div class="field">
    <label for="name">Name</label>
    <div class="control">
        <input type="text" name="name" class="border-gray-200 border rounded p-2" value="{{ $hive->name }}">
    </div>
</div>

<div class="field">
    <label for="apiary_id">Apiary</label>
    <div class="control">
        <select name="apiary_id">
            @foreach (Auth::user()->apiaries as $apiary)
                <option value="{{ $apiary->id }}" {{ isset($hive->apiary) ? $hive->apiary->id === $apiary->id ? 'selected' : '' : '' }}>{{ $apiary->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="field">
    <label for="hive_type_id">Hive type</label>
    <div class="control">
        <select name="hive_type_id">
            @foreach (Auth::user()->hiveTypes as $hiveType)
                <option value="{{ $hiveType->id }}" {{ isset($hive->type) ? $hive->type->id === $hiveType->id ? 'selected' : '' : '' }}>{{ $hiveType->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="control">
    <button type="submit">{{ $buttonText }}</button>
</div>
