@extends('layouts.app')

@section('pageTitle', 'My Apiaries')

@section('headerButton')
    @include('layouts.button', ['text' => 'Create apiary', 'url' => route('apiaries.create')])
@endsection

@section('content')
    @if(!$apiaries->count())
        <div class="bg-white p-6 rounded-lg w-full flex justify-center items-center text-center" style="height: 75vh">
            <div>
                <img src="/images/bee.svg" alt="Bee free" class="w-24 m-auto">
                <h2 class="mb-6 text-3xl">No apiaries found</h2>
                @include('layouts.button', ['text' => 'Create your first apiary', 'url' => route('apiaries.create')])
            </div>
        </div>
    @else
        <div class="lg:flex lg:flex-wrap -mx-4 item-blocks">
            @foreach ($apiaries as $apiary)
                <div class="lg:w-1/2 px-4 my-4">
                    <div class="shadow rounded bg-white h-full relative hover-trigger">
                        <dropdown align="right" margin="8" class="mr-4">
                            <template v-slot:trigger>
                                <button class="absolute right-0 top-0 text-sm text-white z-20 dots hover:text-gray-200 mt-3"><i class="fas fa-ellipsis-h"></i></button>
                            </template>
                            <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                                <a href="{{ $apiary->path() . '/edit' }}" class="inline-block p-2"><i class="fas fa-edit text-sm mr-2"></i>Edit apiary</a>
                            </div>
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
                        <a href="{{ $apiary->path() }}" class="absolute w-full h-full top-0 bottom-0 left-0 right-0 z-10"></a>
                        <div class="w-auto h-32 bg-gray-900 absolute top-0 left-0 right-0 rounded-t-lg hover-target"></div>
                        @if($apiary->image)
                            <div class="w-auto h-32 bg-no-repeat bg-cover bg-center rounded-t-lg" style="background-image: url('{{ Storage::url('images/apiaries/'.$apiary->image.'_thumb.jpg') }}')"></div>
                        @else
                            <div class="flex items-center justify-center w-auto h-32 rounded-t-lg bg-primary-300">
                                <i class="fas fa-map-marker-alt text-4xl text-primary-800"></i>
                            </div>
                        @endif
                        <div class="p-6">
                            <p class="text-2xl font-title text-gray-900 block">{{ $apiary->name }}</p>
                            Location: {{ $apiary->location }}
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $apiaries->links() }}
        </div>
    @endif
@endsection
