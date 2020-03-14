<?php

namespace App\Http\Controllers;

use App\Http\Requests\QueenRequest;
use App\Queen;
use Illuminate\Http\Request;

class QueenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queens = auth()->user()->queens()->latest()->paginate(15);

        return view('queens.index', compact('queens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->put('url.intended', url()->previous());

        return view('queens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QueenRequest $request)
    {
        $queen = auth()->user()->queens()->create($request->validated());

        return redirect()->intended(route('queens.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Queen  $queen
     * @return \Illuminate\Http\Response
     */
    public function edit(Queen $queen)
    {
        $this->authorize('view', $queen);
        session()->put('url.intended', url()->previous());

        return view('queens.edit', compact('queen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Queen  $queen
     * @return \Illuminate\Http\Response
     */
    public function update(QueenRequest $request, Queen $queen)
    {
        $this->authorize('update', $queen);

        $queen->update($request->validated());

        return redirect()->intended(route('queens.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Queen  $queen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Queen $queen)
    {
        $this->authorize('delete', $queen);

        if ($queen->hive) {
            return redirect(route('queens.index'))->withErrors(['delete' => 'This queen has a hive. Can\'t delete it.']);
        }

        $queen->delete();

        return redirect(route('queens.index'));
    }
}
