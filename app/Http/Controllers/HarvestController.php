<?php

namespace App\Http\Controllers;

use App\Harvest;
use App\Helpers\UnitSystemHelper;
use App\Hive;
use App\Http\Requests\HarvestRequest;
use Illuminate\Http\Request;

class HarvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $harvests = auth()->user()->harvests()->latest()->paginate(15);

        return view('harvests.index', compact('harvests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        setPreviousUrl();

        return view('harvests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HarvestRequest $request
     * @param Harvest $harvest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(HarvestRequest $request)
    {
        $harvest = auth()->user()->harvests()->create($request->except(['hive_id']));

        $hive = $request->hive_id;
        $harvest->hives()->attach($hive);

        return redirect(route('harvests.index'))->with('flashMessage', ['description' => 'Harvest created successfully!', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Harvest $harvest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Harvest $harvest)
    {
        $this->authorize('view', $harvest);

        return view('harvests.show', compact('harvest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Harvest $harvest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Harvest $harvest)
    {
        $this->authorize('view', $harvest);

        setPreviousUrl();

        return view('harvests.edit', compact('harvest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Harvest $harvest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(HarvestRequest $request, Harvest $harvest)
    {
        $this->authorize('update', $harvest);

        $harvest->update($request->except(['hive_id']));

        $hives = $request->hive_id;

        $harvest->hives()->sync($hives);

        return redirect($harvest->path())->with('flashMessage', ['description' => 'Harvest edited successfully!', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Harvest $harvest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Harvest $harvest)
    {
        $this->authorize('delete', $harvest);

        $harvest->delete();

        return redirect(route('harvests.index'))->with('flashMessage', ['description' => 'Harvest deleted successfully!', 'type' => 'warning']);
    }
}
