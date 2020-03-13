<div class="form-content flex -mx-4 justify-center">
    <div class="w-1/2 px-4 my-4">
        <div class="shadow rounded-lg p-6 bg-white h-full relative">
            <h2 class="text-3xl">@yield('title')</h2>
            @yield('form')
            <div class="control">
                <button type="submit" class="rounded px-6 py-4 mt-4 bg-secondary-500 text-white inline-block">@yield('button')</button>
            </div>
        </div>
    </div>
</div>

