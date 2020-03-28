@extends('layouts.app')

@section('pageTitle', 'My Inspections')

@section('headerButton')
    @include('layouts.button', ['text' => 'Log a inspection', 'url' => route('inspections.create')])
@stop

@section('content')
    <div class="py-4 table-overview">
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th class="py-2 px-4">Hive</th>
                    <th class="py-2 px-4">Date</th>
                    <th class="py-2 px-4">Pollen arriving</th>
                    <th class="py-2 px-4">Comb building</th>
                    <th class="py-2 px-4">Weather</th>
                    <th class="py-2 px-4">Temperature</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inspections as $inspection)
                    <tr class="hover:bg-white cursor-pointer">
                        <td class="py-2 px-4" onclick="window.location='{{ $inspection->path() }}';">{{ $inspection->hive->name }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $inspection->path() }}';">{{ $inspection->date }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $inspection->path() }}';">{{ $inspection->pollen_arriving }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $inspection->path() }}';">{{ $inspection->comb_building }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $inspection->path() }}';">{{ $inspection->weather }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $inspection->path() }}';">{{ $inspection->temperature }}</td>

                        <td class="py-2 px-4">
                            <dropdown align="right" margin="0">
                                <template v-slot:trigger>
                                    <button class="text-sm text-gray-500 z-20 dots hover:text-gray-700"><i class="fas fa-ellipsis-h"></i></button>
                                </template>
                                <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                                    <a href="{{ $inspection->path() . '/edit' }}" class="inline-block p-2"><i class="fas fa-edit text-sm mr-2"></i>@lang('inspections.edit')</a>
                                </div>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $inspections->links() }}
        @include('partials.errors')
    </div>
@endsection
