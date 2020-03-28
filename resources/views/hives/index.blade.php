@extends('layouts.app')

@section('pageTitle')
    @lang('hives.title')
@endsection

@section('subHeaders')
    @include('hives.subheader')
@stop

@section('headerButton')
    @include('layouts.button', ['text' => __('hives.create'), 'url' => route('hives.create')])
@stop

@section('content')
    <div class="lg:flex lg:flex-wrap -mx-4 item-blocks">
        @foreach ($hives as $hive)
            <div class="lg:w-1/3 px-4 my-4">
                <div class="shadow rounded-lg bg-white h-full relative hover-trigger">
                    <dropdown align="right" margin="8" class="mr-4">
                        <template v-slot:trigger>
                            <button class="absolute right-0 top-0 text-sm text-white z-20 dots hover:text-gray-200 mt-3"><i class="fas fa-ellipsis-h"></i></button>
                        </template>
                        <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                            <a href="{{ $hive->path() . '/edit' }}" class="inline-block p-2"><i class="fas fa-edit text-sm mr-2"></i>@lang('hives.edit')</a>
                        </div>
                        <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                            <a href="{{ $hive->path() }}" class="inline-block p-2"><i class="fas fa-archive text-sm mr-2"></i>@lang('hives.archive')</a>
                        </div>
                        <modal>
                            <div class="hover:bg-secondary-100 -mx-2 px-2 cursor-pointer" slot="button">
                                <a class="inline-block p-2 warning block text-red-800"><i class="fas fa-trash text-sm mr-2"></i>@lang('hives.delete')</a>
                            </div>
                            <span slot="header">@lang('hives.delete') {{ $hive->name }}?</span>
                            <p slot="body">@lang('hives.deleteBody')</p>
                            <span slot="cancel">@lang('general.cancel')</span>
                            <div slot="footer">
                                <a href="{{ $hive->path() }}"
                                   class="btn btn-warning"
                                   onclick="event.preventDefault();
                                       document.getElementById('delete-hive-{{ $hive->id }}').submit();" class="block text-red-800"
                                >
                                    <i class="fas fa-trash text-sm mr-2"></i>@lang('hives.delete')
                                </a>

                                <form id="delete-hive-{{ $hive->id }}" action="{{ $hive->path() }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </modal>
                    </dropdown>
                    <a href="{{ $hive->path() }}" class="absolute w-full h-full top-0 bottom-0 left-0 right-0 z-10"></a>
                    <div class="w-auto h-32 bg-gray-900 absolute top-0 left-0 right-0 rounded-t-lg hover-target"></div>
                    @if($hive->image)
                        <div class="w-auto h-32 bg-no-repeat bg-cover bg-center rounded-t-lg" style="background-image: url('{{ Storage::url($hive->image) }}')"></div>
                    @else
                        <div class="flex items-center justify-center w-auto h-32 rounded-t-lg bg-primary-300">
                            <i class="fas fa-archive text-4xl text-primary-800"></i>
                        </div>
                    @endif
                    <div class="p-6">
                        <p class="text-2xl font-title text-gray-900 block">{{ $hive->name }}</p>
                        @lang('general.location'): {{ $hive->apiary->location }}
                    </div>
                </div>
            </div>
        @endforeach
        {{ $hives->links() }}
    </div>
@endsection
