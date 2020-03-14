<?php

namespace App\Http\Controllers;

use App\Http\Requests\InspectionRequest;
use App\Inspection;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspections = auth()->user()->inspections()->latest()->paginate(15);

        return view('inspections.index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inspections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InspectionRequest $request)
    {
        auth()->user()->inspections()->create($request->validated());

        return redirect(route('inspections.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show(Inspection $inspection)
    {
        $this->authorize('view', $inspection);

        return view('inspections.show', compact('inspection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        $this->authorize('view', $inspection);

        return view('inspections.edit', compact('inspection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function update(InspectionRequest $request, Inspection $inspection)
    {
        $this->authorize('update', $inspection);

        $inspection->update($request->validated());

        return redirect($inspection->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspection $inspection)
    {
        $this->authorize('delete', $inspection);

        $inspection->delete();

        return redirect(route('inspections.index'));
    }
}
