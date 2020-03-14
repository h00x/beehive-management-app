<?php

namespace App\Http\Controllers;

use App\Apiary;
use App\Http\Requests\ApiaryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiaries = auth()->user()->apiaries()->paginate(9);

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
        if (isset($request->apiary_image)) {
            $imagePath = $request->file('apiary_image')->store('public/images/apiaries');
            $request->merge(['image' => $imagePath]);
        }

        $apiary = auth()->user()->apiaries()->create($request->except('apiary_image'));

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

        if (isset($request->apiary_image)) {
            Storage::delete($apiary->image);
            $imagePath = $request->file('apiary_image')->store('public/images/apiaries');
            $request->merge(['image' => $imagePath]);
        }

        $apiary->update($request->except('apiary_image'));

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

        Storage::delete($apiary->image);
        $apiary->delete();

        return redirect(route('apiaries.index'));
    }
}
