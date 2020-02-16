<div class="field">
    <label for="name">Name</label>
    <div class="control">
        <input type="text" name="name" class="border-gray-200 border rounded p-2" value="{{ old('name', $hive->name) }}">
    </div>
</div>

<div class="field">
    <label for="beehive_image">Beehive image</label>
    <div class="control">
        <input type="file" accept="image/*" name="beehive_image" class="border-gray-200 border rounded p-2">
    </div>
</div>

<div class="field">
    <label for="apiary_id">Apiary</label>
    <div class="control">
        @if (Auth::user()->apiaries->isNotEmpty())
            <select name="apiary_id">
                @foreach (Auth::user()->apiaries as $apiary)
                    <option value="{{ $apiary->id }}" {{ checkIdForSelected($apiary->id, $hive->apiary_id, intval(old('apiary_id'))) }}>{{ $apiary->name }}</option>
                @endforeach
            </select>
        @endif
        <a href="{{ route('apiaries.create') }}">Create an apiary</a>
    </div>
</div>

<div class="field">
    <label for="hive_type_id">Hive type</label>
    <div class="control">
        <select name="hive_type_id">
            @foreach (Auth::user()->hiveTypes as $hiveType)
                <option value="{{ $hiveType->id }}" {{ checkIdForSelected($hiveType->id, $hive->type_id, intval(old('hive_type_id'))) }}>{{ $hiveType->name }}</option>
            @endforeach
        </select>
        <a href="{{ route('types.create') }}">Create a custom hive type</a>
    </div>
</div>

<div class="field">
    <label for="queen_id">Queen</label>
    <div class="control">
        @if (Auth::user()->availableQueens()->count() || $hive->queen)
            <select name="queen_id">
                @foreach (Auth::user()->queens as $queen)
                    @if (!$queen->hasAHive() || $queen->is($hive->queen))
                        <option value="{{ $queen->id }}" {{ checkIdForSelected($queen->id, $hive->queen_id, intval(old('queen_id'))) }}>{{ $queen->name }}</option>
                    @endif
                @endforeach
            </select>
        @endif
        <a href="{{ route('queens.create') }}">Create a queen</a>
    </div>
</div>

<div class="control">
    <button type="submit">{{ $buttonText }}</button>
</div>
