<?php

namespace App\Http\Controllers;

use App\HiveType;
use App\Http\Requests\HiveTypeRequest;
use Illuminate\Http\Request;

class HiveTypeController extends Controller
{
    public function index()
    {
        $types = auth()->user()->accessibleHiveTypes();

        return view('hives.types.index', compact('types'));
    }

    public function create()
    {
        return view('hives.types.create');
    }

    public function store(HiveTypeRequest $request)
    {
        $type = auth()->user()->hiveTypes()->create($request->validated());

        return redirect($type->path());
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

        $type->delete();

        return redirect(route('types.index'));
    }
}
