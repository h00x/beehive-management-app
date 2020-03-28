@extends('layouts.app')

@section('pageTitle', 'Inspection: ' . $inspection->hive->name . ' ' . $inspection->date)

@section('overviewUrl', route('inspections.index'))

@section('headerButton')
    @include('layouts.button', ['text' => 'Edit inspection', 'url' => $inspection->path() . '/edit'])
@endsection

@section('deleteLink')
    <dropdown align="right" margin="0">
        <template v-slot:trigger>
            <button class="text-sm text-gray-500 z-20 dots hover:text-gray-700"><i class="fas fa-ellipsis-h"></i></button>
        </template>
        <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
            <a href="{{ $inspection->path() }}" class="inline-block p-2"><i class="fas fa-archive text-sm mr-2"></i>@lang('inspections.archive')</a>
        </div>
        <modal>
            <div class="hover:bg-secondary-100 -mx-2 px-2 cursor-pointer" slot="button">
                <a class="inline-block p-2 warning block text-red-800"><i class="fas fa-trash text-sm mr-2"></i>@lang('inspections.delete')</a>
            </div>
            <span slot="header">@lang('inspections.delete') {{ $inspection->name }}?</span>
            <p slot="body">@lang('inspections.deleteBody')</p>
            <span slot="cancel">@lang('general.cancel')</span>
            <div slot="footer">
                <a href="{{ $inspection->path() }}"
                   class="btn btn-warning"
                   onclick="event.preventDefault();
                       document.getElementById('delete-inspection-{{ $inspection->id }}').submit();" class="block text-red-800"
                >
                    <i class="fas fa-trash text-sm mr-2"></i>@lang('inspections.delete')
                </a>

                <form id="delete-inspection-{{ $inspection->id }}" action="{{ $inspection->path() }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </modal>
    </dropdown>
@stop

@section('content')

    <p>Date: {{ $inspection->date }}</p>
    <p>Hive: <a href="{{ $inspection->hive->path() }}">{{ $inspection->hive->name }}</a></p>
    <p>Queen seen: {{ $inspection->queen_seen ? 'Yes' : 'No' }}</p>
    <p>Larval seen: {{ $inspection->larval_seen ? 'Yes' : 'No' }}</p>
    <p>Young larval seen: {{ $inspection->young_larval_seen ? 'Yes' : 'No' }}</p>
    <p>Pollen arriving: {{ $inspection->pollen_arriving }}</p>
    <p>Comb building: {{ $inspection->comb_building }}</p>
    <p>Notes: {{ $inspection->notes }}</p>
    <p>Weather: {{ $inspection->weather }}</p>
    <p>Temperature: {{ $inspection->temperature }}</p>
@endsection
