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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $queens = auth()->user()->queens()->latest()->paginate(15);

        return view('queens.index', compact('queens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        setPreviousUrl();

        return view('queens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QueenRequest $request)
    {
        $queen = auth()->user()->queens()->create($request->validated());

        return redirect()->intended(route('queens.index'))->with('flashMessage', ['description' => 'Queen created successfully!', 'type' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Queen $queen
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Queen $queen)
    {
        $this->authorize('view', $queen);

        setPreviousUrl();

        return view('queens.edit', compact('queen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Queen $queen
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(QueenRequest $request, Queen $queen)
    {
        $this->authorize('update', $queen);

        $queen->update($request->validated());

        return redirect()->intended(route('queens.index'))->with('flashMessage', ['description' => 'Queen edited successfully!', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Queen $queen
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Queen $queen)
    {
        $this->authorize('delete', $queen);

        if ($queen->hive) {
            return redirect(route('queens.index'))->with('flashMessage', ['description' => 'This queen has a hive. Can\'t delete it.', 'type' => 'danger']);
        }

        $queen->delete();

        return redirect(route('queens.index'))->with('flashMessage', ['description' => 'Queen deleted successfully!', 'type' => 'warning']);
    }
}
