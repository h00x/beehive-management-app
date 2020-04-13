@extends('layouts.app')

@section('pageTitle', 'Apiary: ' . $apiary->name)

@section('overviewUrl', route('apiaries.index'))

@section('headerButton')
    @include('layouts.button', ['text' => 'Edit apiary', 'url' => $apiary->path() . '/edit'])
@endsection

@section('deleteLink')
    <dropdown align="right" margin="0">
        <template v-slot:trigger>
            <button class="text-sm text-gray-500 z-20 dots hover:text-gray-700"><i class="fas fa-ellipsis-h"></i></button>
        </template>
        <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
            <a href="{{ $apiary->path() }}" class="inline-block p-2"><i class="fas fa-archive text-sm mr-2"></i>@lang('apiaries.archive')</a>
        </div>
        <modal>
            <div class="hover:bg-secondary-100 -mx-2 px-2 cursor-pointer" slot="button">
                <a class="inline-block p-2 warning block text-red-800"><i class="fas fa-trash text-sm mr-2"></i>@lang('apiaries.delete')</a>
            </div>
            <span slot="header">@lang('apiaries.delete') {{ $apiary->name }}?</span>
            <p slot="body">@lang('apiaries.deleteBody')</p>
            <span slot="cancel">@lang('general.cancel')</span>
            <div slot="footer">
                <a href="{{ $apiary->path() }}"
                   class="btn btn-warning"
                   onclick="event.preventDefault();
                       document.getElementById('delete-apiary-{{ $apiary->id }}').submit();" class="block text-red-800"
                >
                    <i class="fas fa-trash text-sm mr-2"></i>@lang('apiaries.delete')
                </a>

                <form id="delete-apiary-{{ $apiary->id }}" action="{{ $apiary->path() }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </modal>
    </dropdown>
@stop


@section('content')
    @if($apiary->image)
        <div class="w-auto h-48 bg-no-repeat bg-cover bg-center mb-12" style="background-image: url('{{ Storage::url('images/apiaries/'.$apiary->image.'.jpg') }}')"></div>
    @endif
    <p>Location: {{ $geocode['formatted_address'] !== 'result_not_found' ? $geocode['formatted_address'] : $apiary->location }}</p>
    @if(isset($weather))
        <p>Temperature: {{ $weather->currently->temperature }}</p>
        <p>Weather: {{ $weather->currently->summary }}</p>
    @endif
    <google-map
        :center="{lat:{{ $geocode['lat'] }}, lng:{{ $geocode['lng'] }}}"
        :zoom="12"
        map-type-id="terrain"
        class="w-full h-64"
    >
        <google-map-marker
            :position="{lat:{{ $geocode['lat'] }}, lng:{{ $geocode['lng'] }}}"
        ></google-map-marker>
    </google-map>
@endsection
