<div class="field">
    <label for="date">Inspection date</label>
    <div class="control">
        <input type="datetime-local" name="date" class="border-gray-200 border rounded p-2" value="{{ Carbon\Carbon::parse($inspection->date)->format('Y-m-d\TH:i') ?? Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
    </div>
</div>

<div class="field">
    <label for="hive_id">Hive</label>
    <div class="control">
        @if (Auth::user()->hives->isNotEmpty())
            <select name="hive_id">
                @foreach (Auth::user()->hives as $hive)
                    <option value="{{ $hive->id }}" {{ $inspection->hive === $hive ? 'selected' : '' }}>{{ $hive->name }}</option>
                @endforeach
            </select>
        @else
            <a href="{{ route('hives.create') }}">Create a hive</a>
        @endif
    </div>
</div>

<div class="field">
    <div class="control">
        <input type="checkbox" name="queen_seen" value="1" {{ $inspection->queen_seen ? 'checked' : '' }}>
        <label for="queen_seen">Queen seen</label>
    </div>
</div>

<div class="field">
    <div class="control">
        <input type="checkbox" name="larval_seen" value="1" {{ $inspection->larval_seen ? 'checked' : '' }}>
        <label for="larval_seen">Larval seen</label>
    </div>
</div>

<div class="field">
    <div class="control">
        <input type="checkbox" name="young_larval_seen" value="1" {{ $inspection->young_larval_seen ? 'checked' : '' }}>
        <label for="young_larval_seen">Young larval seen</label>
    </div>
</div>

<div class="field">
    <label for="pollen_arriving">Pollen arriving</label>
    <div class="control">
        <input type="number" name="pollen_arriving" class="border-gray-200 border rounded p-2" value="{{ $inspection->pollen_arriving }}" min="0" max="100">
    </div>
</div>

<div class="field">
    <label for="comb_building">Comb building</label>
    <div class="control">
        <input type="number" name="comb_building" class="border-gray-200 border rounded p-2" value="{{ $inspection->comb_building }}" min="0" max="100">
    </div>
</div>

<div class="field">
    <label for="notes">Notes</label>
    <div class="control">
        <textarea name="notes" cols="30" rows="10" class="border-gray-200 border rounded p-2">
            {{ $inspection->notes }}
        </textarea>
    </div>
</div>

<div class="field">
    <label for="weather">Weather</label>
    <div class="control">
        <input type="text" name="weather" class="border-gray-200 border rounded p-2" value="{{ $inspection->weather }}">
    </div>
</div>

<div class="field">
    <label for="temperature">Temperature</label>
    <div class="control">
        <input type="number" name="temperature" class="border-gray-200 border rounded p-2" value="{{ $inspection->temperature }}" min="-40" max="80">
    </div>
</div>

<div class="control">
    <button type="submit">{{ $buttonText }}</button>
</div>
