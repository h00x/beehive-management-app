<?php

namespace App\Http\Controllers;

use App\Hive;
use App\Http\Requests\CreateHiveRequest;
use Illuminate\Http\Request;

class HiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hives = auth()->user()->accessibleHives();

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
     * @param CreateHiveRequest $request
     * @return void
     */
    public function store(CreateHiveRequest $request)
    {
        $hive = auth()->user()->hives()->create($request->validated());

        return redirect($hive->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hive  $hive
     * @return \Illuminate\Http\Response
     */
    public function show(Hive $hive)
    {
        return view('hives.show', compact('hive'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hive  $hive
     * @return \Illuminate\Http\Response
     */
    public function edit(Hive $hive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hive  $hive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hive $hive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hive  $hive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hive $hive)
    {
        //
    }
}
