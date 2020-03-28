@extends('layouts.app')

@section('pageTitle', 'My Hive Types')

@section('headerButton')
    @include('layouts.button', ['text' => 'Create a hive type', 'url' => route('types.create')])
@stop

@section('content')
    <div class="table-overview">
        <table class="w-full table-fixed">
            <thead>
                <tr class="text-left">
                    <th class="py-2 px-4">Hive type</th>
                    <th class="py-2 px-4">Number of hives</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr class="hover:bg-white">
                        <td class="py-2 px-4">{{ $type->name }}</td>
                        <td class="py-2 px-4">{{ $type->hives->count() }}</td>
                        <td class="flex justify-end py-2 px-4">
                            @if (!$type->protected)
                                <dropdown align="right" margin="0">
                                    <template v-slot:trigger>
                                        <button class="text-sm text-gray-500 z-20 dots hover:text-gray-700"><i class="fas fa-ellipsis-h"></i></button>
                                    </template>
                                    <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                                        <a href="{{ $type->path() . '/edit' }}" class="inline-block p-2"><i class="fas fa-edit text-sm mr-2"></i>@lang('hivetypes.edit')</a>
                                    </div>
                                    <modal>
                                        <div class="hover:bg-secondary-100 -mx-2 px-2 cursor-pointer" slot="button">
                                            <a class="inline-block p-2 warning block text-red-800"><i class="fas fa-trash text-sm mr-2"></i>@lang('hivetypes.delete')</a>
                                        </div>
                                        <span slot="header">@lang('hivetypes.delete') {{ $type->name }}?</span>
                                        <p slot="body">@lang('hivetypes.deleteBody')</p>
                                        <span slot="cancel">@lang('general.cancel')</span>
                                        <div slot="footer">
                                            <a href="{{ $type->path() }}"
                                               class="btn btn-warning"
                                               onclick="event.preventDefault();
                                                   document.getElementById('delete-hive-type-{{ $type->id }}').submit();" class="block text-red-800"
                                            >
                                                <i class="fas fa-trash text-sm mr-2"></i>@lang('hivetypes.delete')
                                            </a>

                                            <form id="delete-hive-type-{{ $type->id }}" action="{{ $type->path() }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </modal>
                                </dropdown>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $types->links() }}
        @include('partials.errors')
    </div>
@endsection
