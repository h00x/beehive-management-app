@extends('layouts.app')

@section('pageTitle', 'My Hives')

@section('subHeaders')
    @include('hives.subheader')
@stop

@section('actions')
    @include('layouts.button', ['text' => 'Create hive', 'url' => route('hives.create')])
@stop

@section('content')
    <div class="lg:flex lg:flex-wrap -mx-4">
        @foreach ($hives as $hive)
            <div class="lg:w-1/3 px-4 my-4">
                <div class="shadow rounded-lg p-6 bg-white h-full relative hover-trigger">
                    <dropdown align="right" margin="6" class="-mr-2 -mt-3">
                        <template v-slot:trigger>
                            <button class="absolute right-0 top-0 text-sm text-white z-20"><i class="fas fa-ellipsis-h"></i></button>
                        </template>
                        <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                            <a href="{{ $hive->path() . '/edit' }}" class="inline-block p-2"><i class="fas fa-edit text-sm mr-2"></i>Edit hive</a>
                        </div>
                        <div class="hover:bg-secondary-100 -mx-2 px-2">
                            <a href="{{ $hive->path() }}"
                               class="inline-block p-2 text-red-500"
                               onclick="event.preventDefault();
                                        document.getElementById('delete-hive-{{ $hive->id }}').submit();" class="block text-red-800"
                            >
                                <i class="fas fa-trash text-sm mr-2"></i>Delete hive
                            </a>

                            <form id="delete-hive-{{ $hive->id }}" action="{{ $hive->path() }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </dropdown>
                    <a href="{{ $hive->path() }}" class="absolute w-full h-full top-0 bottom-0 left-0 right-0 z-10"></a>
                    <div class="w-auto h-32 bg-gray-900 absolute top-0 left-0 right-0 rounded-t-lg opacity-75 hover-target"></div>
                    <div class="w-auto h-32 bg-no-repeat bg-cover bg-center -mx-6 -mt-6 mb-6 rounded-t-lg" style="background-image: url('{{ Storage::url($hive->image) }}')"></div>
                    <p class="text-2xl font-title text-gray-900 block">{{ $hive->name }}</p>
                    Location: {{ $hive->apiary->location }}
                </div>
            </div>
        @endforeach
    </div>
@endsection
