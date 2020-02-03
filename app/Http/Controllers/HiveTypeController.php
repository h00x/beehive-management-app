<?php

namespace App\Http\Controllers;

use App\HiveType;
use App\Http\Requests\HiveTypeRequest;
use Illuminate\Http\Request;

class HiveTypeController extends Controller
{
    public function index()
    {
        $hives = auth()->user()->accessibleHiveTypes();

        return view('hiveTypes.index', compact('hives'));
    }

    public function create()
    {
        return view('hiveTypes.create');
    }

    public function store(HiveTypeRequest $request)
    {
        $hiveType = auth()->user()->hiveTypes()->create($request->validated());

        return redirect($hiveType->path());
    }

    public function show(HiveType $hiveType)
    {
        $this->authorize('view', $hiveType);

        return view('hiveTypes.show', compact('hiveType'));
    }

    public function edit(HiveType $hiveType)
    {
        $this->authorize('view', $hiveType);

        return view('hiveTypes.edit', compact('hiveType'));
    }

    public function update(HiveTypeRequest $request, HiveType $hiveType)
    {
        $this->authorize('update', $hiveType);

        $hiveType->update($request->validated());

        return redirect($hiveType->path());
    }

    public function destroy(HiveType $hiveType)
    {
        $this->authorize('delete', $hiveType);

        $hiveType->delete();

        return redirect(route('hiveTypes.index'));
    }
}
