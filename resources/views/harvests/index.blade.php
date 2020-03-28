@extends('layouts.app')

@section('pageTitle', 'My Harvests')

@section('headerButton')
    @include('layouts.button', ['text' => __('harvests.create'), 'url' => route('harvests.create')])
@stop

@section('content')
    <div class="py-4 table-overview">
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Harvest date</th>
                    <th class="py-2 px-4">Batch code</th>
                    <th class="py-2 px-4">Weight</th>
                    <th class="py-2 px-4">Moister content</th>
                    <th class="py-2 px-4">Nectar source</th>
                    <th class="py-2 px-4">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($harvests as $harvest)
                    <tr class="hover:bg-white cursor-pointer">
                        <td class="py-2 px-4" onclick="window.location='{{ $harvest->path() }}';">{{ $harvest->name }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $harvest->path() }}';">{{ $harvest->date }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $harvest->path() }}';">{{ $harvest->batch_code }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $harvest->path() }}';">{{ $harvest->weight }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $harvest->path() }}';">{{ $harvest->moister_content }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $harvest->path() }}';">{{ $harvest->nectar_source }}</td>
                        <td class="py-2 px-4" onclick="window.location='{{ $harvest->path() }}';">{{ $harvest->description }}</td>

                        <td class="flex justify-end py-2 px-4 z-20">
                            <dropdown align="right" margin="0">
                                <template v-slot:trigger>
                                    <button class="text-sm text-gray-500 z-20 dots hover:text-gray-700"><i class="fas fa-ellipsis-h"></i></button>
                                </template>
                                <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                                    <a href="{{ $harvest->path() . '/edit' }}" class="inline-block p-2"><i class="fas fa-edit text-sm mr-2"></i>@lang('harvests.edit')</a>
                                </div>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $harvests->links() }}
        @include('partials.errors')
    </div>
@endsection
