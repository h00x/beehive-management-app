@extends('layouts.app')

@section('pageTitle', 'My Queens')

@section('content')
    @include('layouts.button', ['text' => 'Create a queen', 'url' => route('queens.create')])

    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th>Queen</th>
                    <th>Race</th>
                    <th>Marking</th>
                    <th>Hive</th>
                    <th>Edit queen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queens as $queen)
                    <tr>
                        <td>{{ $queen->name }}</td>
                        <td>{{ $queen->race }}</td>
                        <td>{{ $queen->marking }}</td>
                        <td><a href="{{$queen->hive->path()}}">{{ $queen->hive->name }}</a></td>
                        <td>
                            <a
                                href="{{ $queen->path() . '/edit' }}"
                            >Edit</a>
                            <a
                                href="{{ $queen->path() }}"
                                class="text-red-500"
                                onclick="event.preventDefault();
                                    document.getElementById('{{ 'delete-hive-type-' . $queen->id }}').submit();"
                            >Delete</a>
                            <form id="{{ 'delete-hive-type-' . $queen->id }}" action="{{ $queen->path() }}" method="POST" class="hidden">
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
