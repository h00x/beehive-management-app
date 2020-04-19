<?php

namespace App\Http\Controllers;

use App\Helpers\HiveHelper;
use App\Hive;
use App\Http\Requests\HiveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\Activitylog\Models\Activity;

class HiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $hives = auth()->user()->hives()->latest()->paginate(9);

        return view('hives.index', compact('hives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        setPreviousUrl();

        return view('hives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HiveRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(HiveRequest $request)
    {
        if ($request->hasFile('beehive_image')) {
            $hiveImageName = HiveHelper::storeHiveImages($request);

            $request->merge(['image' => $hiveImageName]);
        }

        $hive = auth()->user()->hives()->create($request->except('beehive_image'));

        return redirect($hive->path())->with('flashMessage.success','Hive created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Hive $hive
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Hive $hive)
    {
        $this->authorize('view', $hive);

        setPreviousUrl();

        return view('hives.edit', compact('hive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HiveRequest $request
     * @param \App\Hive $hive
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(HiveRequest $request, Hive $hive)
    {
        $this->authorize('update', $hive);

        if ($request->hasFile('beehive_image')) {
            $hiveImageName = HiveHelper::storeHiveImages($request, $hive);

            $request->merge(['image' => $hiveImageName]);
        }

        $hive->update($request->except('beehive_image'));

        return redirect($hive->path())->with('flashMessage', ['description' => 'Hive updated successfully!', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Hive $hive
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Hive $hive)
    {
        $this->authorize('delete', $hive);

        Storage::delete([
            'public/images/hives/'.$hive->image.'.jpg',
            'public/images/hives/'.$hive->image.'_thumb.jpg'
        ]);

        $hive->delete();

        return redirect(route('hives.index'))->with('flashMessage', ['description' => 'Hive deleted successfully!', 'type' => 'warning']);
    }
}
