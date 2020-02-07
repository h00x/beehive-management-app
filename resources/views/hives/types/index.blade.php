@extends('layouts.app')

@section('pageTitle', 'My Hives Types')

@section('content')
    @include('layouts.button', ['text' => 'Create a hive type', 'url' => route('types.create')])

    <div>
        <table class="">
            <thead>
                <tr>
                    <th>Hive type</th>
                    <th>Edit hive type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('partials.errors')
    </div>
@endsection
