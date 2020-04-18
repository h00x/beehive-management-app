@extends('layouts.app')

@section('pageTitle', 'Harvest: ' . $harvest->name)

@section('overviewUrl', route('harvests.index'))

@section('headerButton')
    @include('layouts.button', ['text' => 'Edit harvest', 'url' => $harvest->path() . '/edit'])
@endsection

@section('deleteLink')
    <dropdown align="right" margin="0">
        <template v-slot:trigger>
            <button class="text-sm text-gray-500 z-20 dots hover:text-gray-700"><i class="fas fa-ellipsis-h"></i></button>
        </template>
        <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
            <a href="{{ $harvest->path() }}" class="inline-block p-2"><i class="fas fa-archive text-sm mr-2"></i>@lang('harvests.archive')</a>
        </div>
        <modal>
            <div class="hover:bg-secondary-100 -mx-2 px-2 cursor-pointer" slot="button">
                <a class="inline-block p-2 warning block text-red-800"><i class="fas fa-trash text-sm mr-2"></i>@lang('harvests.delete')</a>
            </div>
            <span slot="header">@lang('harvests.delete') {{ $harvest->name }}?</span>
            <p slot="body">@lang('harvests.deleteBody')</p>
            <span slot="cancel">@lang('general.cancel')</span>
            <div slot="footer">
                <a href="{{ $harvest->path() }}"
                   class="btn btn-warning"
                   onclick="event.preventDefault();
                       document.getElementById('delete-harvest-{{ $harvest->id }}').submit();" class="block text-red-800"
                >
                    <i class="fas fa-trash text-sm mr-2"></i>@lang('harvests.delete')
                </a>

                <form id="delete-harvest-{{ $harvest->id }}" action="{{ $harvest->path() }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </modal>
    </dropdown>
@stop

@section('content')

    <p>Name: {{ $harvest->name }}</p>
    <p>Hives:
        @foreach($harvest->hives as $hive)
            <a href="{{ $hive->path() }}">{{ $hive->name }}</a>,
        @endforeach
    </p>
    <p>Date: {{ $harvest->date }}</p>
    <p>Batch code: {{ $harvest->batch_code }}</p>
    <p>Weight: {{ $harvest->computed_weight }}</p>
    <p>Moister content: {{ $harvest->moister_content }}</p>
    <p>Nectar source: {{ $harvest->nectar_source }}</p>
    <p>Description: {{ $harvest->description }}</p>
@endsection
