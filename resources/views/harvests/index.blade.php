@extends('layouts.app')

@section('pageTitle', 'My Harvests')

@section('actions')
    @include('layouts.button', ['text' => 'Log a harvest', 'url' => route('harvests.create')])
@stop

@section('content')
    <div class="py-4 table-overview">
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th>Name</th>
                    <th>Harvest date</th>
                    <th>Batch code</th>
                    <th>Weight</th>
                    <th>Moister content</th>
                    <th>Nectar source</th>
                    <th>Description</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($harvests as $harvest)
                    <tr>
                        <td><a href="{{ $harvest->path() }}">{{ $harvest->name }}</a></td>
                        <td>{{ $harvest->date }}</td>
                        <td>{{ $harvest->batch_code }}</td>
                        <td>{{ $harvest->weight }}</td>
                        <td>{{ $harvest->moister_content }}</td>
                        <td>{{ $harvest->nectar_source }}</td>
                        <td>{{ $harvest->description }}</td>

                        <td>
                            <a
                                href="{{ $harvest->path() . '/edit' }}"
                            >Edit</a>
                            <a
                                href="{{ $harvest->path() }}"
                                class="text-red-500"
                                onclick="event.preventDefault();
                                    document.getElementById('{{ 'delete-harvest-' . $harvest->id }}').submit();"
                            >Delete</a>
                            <form id="{{ 'delete-harvest-' . $harvest->id }}" action="{{ $harvest->path() }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $harvests->links() }}
        @include('partials.errors')
    </div>
@endsection
