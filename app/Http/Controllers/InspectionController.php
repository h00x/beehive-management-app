<?php

namespace App\Http\Controllers;

use App\Hive;
use App\Http\Requests\InspectionRequest;
use App\Inspection;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $inspections = auth()->user()->inspections()->latest()->paginate(15);

        return view('inspections.index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        setPreviousUrl();

        return view('inspections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(InspectionRequest $request)
    {
        $hive = Hive::find($request['hive_id']);
        $weather = getWeather($hive->apiary->location);

        auth()->user()->inspections()
            ->create(
                array_merge($request->validated(), [
                    'weather' => $weather ? $weather->currently->summary : null,
                    'temperature' => $weather ? $weather->currently->temperature : null
                ])
            );

        return redirect(route('inspections.index'))->with('flashMessage', ['description' => 'Inspection created successfully!', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Inspection $inspection
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Inspection $inspection)
    {
        $this->authorize('view', $inspection);

        return view('inspections.show', compact('inspection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Inspection $inspection
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Inspection $inspection)
    {
        $this->authorize('view', $inspection);

        setPreviousUrl();

        return view('inspections.edit', compact('inspection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Inspection $inspection
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(InspectionRequest $request, Inspection $inspection)
    {
        $this->authorize('update', $inspection);

        $inspection->update($request->validated());

        return redirect($inspection->path())->with('flashMessage', ['description' => 'Inspection edited successfully!', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Inspection $inspection
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Inspection $inspection)
    {
        $this->authorize('delete', $inspection);

        $inspection->delete();

        return redirect(route('inspections.index'))->with('flashMessage', ['description' => 'Inspection deleted successfully!', 'type' => 'warning']);
    }
}
