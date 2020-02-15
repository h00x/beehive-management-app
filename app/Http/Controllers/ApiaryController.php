<?php

namespace App\Http\Controllers;

use App\Apiary;
use App\Http\Requests\ApiaryRequest;
use Illuminate\Http\Request;

class ApiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiaries = auth()->user()->apiaries->all();

        return view('apiaries.index', compact('apiaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->put('url.intended', url()->previous());

        return view('apiaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiaryRequest $request)
    {
        $apiary = auth()->user()->apiaries()->create($request->validated());

        if (session()->get('url.intended') !== route('apiaries.index')) {
            return redirect()->intended($apiary->path());
        }

        return redirect($apiary->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apiary  $apiary
     * @return \Illuminate\Http\Response
     */
    public function show(Apiary $apiary)
    {
        $this->authorize('view', $apiary);

        return view('apiaries.show', compact('apiary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apiary  $apiary
     * @return \Illuminate\Http\Response
     */
    public function edit(Apiary $apiary)
    {
        $this->authorize('view', $apiary);

        return view('apiaries.edit', compact('apiary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apiary  $apiary
     * @return \Illuminate\Http\Response
     */
    public function update(ApiaryRequest $request, Apiary $apiary)
    {
        $this->authorize('update', $apiary);

        $apiary->update($request->validated());

        return redirect($apiary->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apiary  $apiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apiary $apiary)
    {
        $this->authorize('delete', $apiary);

        $apiary->delete();

        return redirect(route('apiaries.index'));
    }
}
