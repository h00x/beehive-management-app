@extends('layouts.app')

@section('pageTitle', 'My Queens')

@section('headerButton')
    @include('layouts.button', ['text' => 'Create a queen', 'url' => route('queens.create')])
@stop

@section('content')
    <div class="table-overview">
        <table class="w-full table-fixed">
            <thead>
                <tr class="text-left">
                    <th class="py-2 px-4">Queen</th>
                    <th class="py-2 px-4">Race</th>
                    <th class="py-2 px-4">Marking</th>
                    <th class="py-2 px-4">Hive</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queens as $queen)
                    <tr class="hover:bg-white">
                        <td class="py-2 px-4">{{ $queen->name }}</td>
                        <td class="py-2 px-4">{{ $queen->race }}</td>
                        <td class="py-2 px-4">{{ $queen->marking }}</td>
                        <td class="py-2 px-4">
                        @if (isset($queen->hive))
                            <a href="{{$queen->hive->path()}}">{{ $queen->hive->name }}</a>
                        @else
                            <i>No hive</i>
                        @endif
                        </td>
                        <td class="flex justify-end py-2 px-4">
                            <dropdown align="right" margin="0">
                                <template v-slot:trigger>
                                    <button class="text-sm text-gray-500 z-20 dots hover:text-gray-700"><i class="fas fa-ellipsis-h"></i></button>
                                </template>
                                <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                                    <a href="{{ $queen->path() . '/edit' }}" class="inline-block p-2"><i class="fas fa-edit text-sm mr-2"></i>@lang('queens.edit')</a>
                                </div>
                                <modal>
                                    <div class="hover:bg-secondary-100 -mx-2 px-2 cursor-pointer" slot="button">
                                        <a class="inline-block p-2 warning block text-red-800"><i class="fas fa-trash text-sm mr-2"></i>@lang('queens.delete')</a>
                                    </div>
                                    <span slot="header">@lang('queens.delete') {{ $queen->name }}?</span>
                                    <p slot="body">@lang('queens.deleteBody')</p>
                                    <span slot="cancel">@lang('general.cancel')</span>
                                    <div slot="footer">
                                        <a href="{{ $queen->path() }}"
                                           class="btn btn-warning"
                                           onclick="event.preventDefault();
                                               document.getElementById('delete-queen-{{ $queen->id }}').submit();" class="block text-red-800"
                                        >
                                            <i class="fas fa-trash text-sm mr-2"></i>@lang('queens.delete')
                                        </a>

                                        <form id="delete-queen-{{ $queen->id }}" action="{{ $queen->path() }}" method="POST" class="hidden">
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
        {{ $queens->links() }}
        @include('partials.errors')
    </div>
@endsection
