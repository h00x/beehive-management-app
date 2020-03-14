@extends('layouts.app')

@section('pageTitle', 'My Apiaries')

@section('actions')
    @include('layouts.button', ['text' => 'Create apiary', 'url' => route('apiaries.create')])
@stop

@section('content')
    <div class="lg:flex lg:flex-wrap -mx-4 item-blocks">
        @foreach ($apiaries as $apiary)
            <div class="lg:w-1/3 px-4 my-4">
                <div class="shadow rounded p-6 bg-white h-full relative hover-trigger">
                    <dropdown align="right" margin="6" class="-mr-2 -mt-3">
                        <template v-slot:trigger>
                            <button class="absolute right-0 top-0 text-sm text-white z-20 dots"><i class="fas fa-ellipsis-h"></i></button>
                        </template>
                        <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                            <a href="{{ $apiary->path() . '/edit' }}" class="inline-block p-2"><i class="fas fa-edit text-sm mr-2"></i>Edit apiary</a>
                        </div>
                        <div class="hover:bg-secondary-100 -mx-2 px-2">
                            <a href="{{ $apiary->path() }}"
                               class="inline-block p-2 warning"
                               onclick="event.preventDefault();
                                   document.getElementById('delete-apiary-{{ $apiary->id }}').submit();" class="block text-red-800"
                            >
                                <i class="fas fa-trash text-sm mr-2"></i>Delete apiary
                            </a>

                            <form id="delete-apiary-{{ $apiary->id }}" action="{{ $apiary->path() }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </dropdown>
                    <a href="{{ $apiary->path() }}" class="absolute w-full h-full top-0 bottom-0 left-0 right-0 z-10"></a>
                    <div class="w-auto h-32 bg-gray-900 absolute top-0 left-0 right-0 rounded-t-lg hover-target"></div>
                    <div class="w-auto h-32 bg-no-repeat bg-cover bg-center -mx-6 -mt-6 mb-6 rounded-t-lg" style="background-image: url('{{ Storage::url($apiary->image) }}')"></div>
                    <p class="text-2xl font-title text-gray-900 block">{{ $apiary->name }}</p>
                    Location: {{ $apiary->location }}
                </div>
            </div>
        @endforeach
        {{ $apiaries->links() }}
    </div>
@endsection
