<?php

namespace App\Http\Controllers;

use App\HiveType;
use App\Http\Requests\HiveTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class HiveTypeController extends Controller
{
    public function index()
    {
        $types = auth()->user()->hiveTypes->all();

        return view('hives.types.index', compact('types'));
    }

    public function create()
    {
        session()->put('url.intended', url()->previous());

        return view('hives.types.create');
    }

    public function store(HiveTypeRequest $request)
    {
        auth()->user()->hiveTypes()->create($request->validated());

        return redirect()->intended(route('types.index'));
    }

    public function edit(HiveType $type)
    {
        $this->authorize('view', $type);

        return view('hives.types.edit', compact('type'));
    }

    public function update(HiveTypeRequest $request, HiveType $type)
    {
        $this->authorize('update', $type);

        $type->update($request->validated());

        return redirect($type->path());
    }

    public function destroy(HiveType $type)
    {
        $this->authorize('delete', $type);

        if (!$type->hives->isEmpty()) {
            return redirect(route('types.index'))->withErrors(['delete' => 'This hive type has hives under it. Can\'t delete it.']);
        }

        $type->delete();

        return redirect(route('types.index'));
    }
}
