<?php

namespace App\Http\Controllers;

use App\Hive;
use App\Http\Requests\HiveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hives = auth()->user()->hives->all();

        return view('hives.index', compact('hives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HiveRequest $request
     * @return void
     */
    public function store(HiveRequest $request)
    {
        if (isset($request->beehive_image)) {
            $imagePath = $request->file('beehive_image')->store('public/images/beehives');
            $request->merge(['image' => $imagePath]);
        }

        $hive = auth()->user()->hives()->create($request->except('beehive_image'));

        return redirect($hive->path());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Hive $hive
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Hive $hive)
    {
        $this->authorize('view', $hive);

        return view('hives.show', compact('hive'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Hive $hive
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Hive $hive)
    {
        $this->authorize('view', $hive);

        return view('hives.edit', compact('hive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HiveRequest $request
     * @param \App\Hive $hive
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(HiveRequest $request, Hive $hive)
    {
        $this->authorize('update', $hive);

        if (isset($request->beehive_image)) {
            Storage::delete($hive->image);
            $imagePath = $request->file('beehive_image')->store('public/images/beehives');
            $request->merge(['image' => $imagePath]);
        }

        $hive->update($request->except('beehive_image'));

        return redirect($hive->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Hive $hive
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Hive $hive)
    {
        $this->authorize('delete', $hive);

        Storage::delete($hive->image);
        $hive->delete();

        return redirect(route('hives.index'));
    }
}
