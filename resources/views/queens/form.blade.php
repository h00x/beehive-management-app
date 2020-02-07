<div class="field">
    <label for="name">Queen name</label>
    <div class="control">
        <input type="text" name="name" class="border-gray-200 border rounded p-2" value="{{ $queen->name }}">
    </div>
</div>

<div class="field">
    <label for="race">Queen race</label>
    <div class="control">
        <input type="text" name="race" class="border-gray-200 border rounded p-2" value="{{ $queen->race }}">
    </div>
</div>

<div class="field">
    <label for="marking">Queen marking</label>
    <div class="control">
        <input type="text" name="marking" class="border-gray-200 border rounded p-2" value="{{ $queen->marking }}">
    </div>
</div>

<div class="control">
    <button type="submit">{{ $buttonText }}</button>
</div>
