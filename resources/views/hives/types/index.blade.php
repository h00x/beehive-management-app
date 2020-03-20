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
                    <th>Hive type</th>
                    <th>Number of hives</th>
                    <th>Edit hive type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->hives->count() }}</td>
                        <td>
                            @if (!$type->protected)
                                <a
                                    href="{{ $type->path() . '/edit' }}"
                                >Edit</a>
                                <a
                                    href="{{ $type->path() }}"
                                    class="text-red-500"
                                    onclick="event.preventDefault();
                                        document.getElementById('{{ 'delete-hive-type-' . $type->id }}').submit();"
                                >Delete</a>
                                <form id="{{ 'delete-hive-type-' . $type->id }}" action="{{ $type->path() }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
