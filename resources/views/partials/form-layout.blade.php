<div class="form-content flex -mx-4 justify-center">
    <div class="w-1/2 px-4 my-4">
        <div class="shadow rounded-lg p-6 bg-white h-full relative">
            @if ($errors->any())
                <flash-message :message="{{ json_encode(['description' => 'Please check the form below for errors', 'type' => 'danger']) }}"></flash-message>
            @endif
            <h2 class="text-3xl">@yield('title')</h2>

            @yield('form')

            <div class="flex items-center justify-between mt-8">
                <a href="{{ session()->get('url.intended') }}"><i class="fas fa-caret-left"></i> @lang('general.back')</a>
                <div class="control">
                    <button type="submit" class="rounded px-6 py-4 bg-secondary-500 text-white inline-block">@yield('button')</button>
                </div>
            </div>

        </div>
    </div>
</div>

