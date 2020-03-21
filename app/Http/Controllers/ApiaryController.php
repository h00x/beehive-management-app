<?php

namespace App\Http\Controllers;

use App\Apiary;
use App\Http\Requests\ApiaryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Lawnstarter\LaravelDarkSky\Facades\DarkSky;
use Spatie\Geocoder\Facades\Geocoder;

class ApiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $apiaries = auth()->user()->apiaries()->latest()->paginate(9);

        return view('apiaries.index', compact('apiaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        setPreviousUrl();

        return view('apiaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ApiaryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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

        return redirect($apiary->path())->with('flashMessage', ['description' => 'Apiary created successfully!', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Apiary $apiary
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Apiary $apiary)
    {
        $this->authorize('view', $apiary);

        $geocode = Geocoder::getCoordinatesForAddress($apiary->location);
        $weather = null;

        if ($geocode['formatted_address'] !== 'result_not_found') {
            $weather = DarkSky::location($geocode['lat'], $geocode['lng'])->excludes(['flags', 'hourly', 'minutely', 'daily', 'offset'])->units('si')->get();
        }


        return view('apiaries.show', compact('apiary', 'weather', 'geocode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Apiary $apiary
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Apiary $apiary)
    {
        $this->authorize('view', $apiary);

        setPreviousUrl();

        return view('apiaries.edit', compact('apiary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Apiary $apiary
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
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

        return redirect($apiary->path())->with('flashMessage', ['description' => 'Apiary updated successfully!', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Apiary $apiary
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Apiary $apiary)
    {
        $this->authorize('delete', $apiary);

        Storage::delete($apiary->image);
        $apiary->delete();

        return redirect(route('apiaries.index'))->with('flashMessage', ['description' => 'Apiary deleted successfully!', 'type' => 'warning']);
    }
}
