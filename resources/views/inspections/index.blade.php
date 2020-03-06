@extends('layouts.app')

@section('pageTitle', 'My Inspections')

@section('content')
    @include('layouts.button', ['text' => 'Log a inspection', 'url' => route('inspections.create')])

    <div>
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th>Hive</th>
                    <th>Date</th>
                    <th>Queen seen</th>
                    <th>Larval seen</th>
                    <th>Young larval seen</th>
                    <th>Pollen arriving</th>
                    <th>Comb building</th>
                    <th>Weather</th>
                    <th>Temperature</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inspections as $inspection)
                    <tr>
                        <td>{{ $inspection->hive->name }}</td>
                        <td>{{ $inspection->date }}</td>
                        <td>{{ $inspection->queen_seen ? 'Yes' : 'No' }}</td>
                        <td>{{ $inspection->larval_seen ? 'Yes' : 'No' }}</td>
                        <td>{{ $inspection->young_larval_seen ? 'Yes' : 'No' }}</td>
                        <td>{{ $inspection->pollen_arriving }}</td>
                        <td>{{ $inspection->comb_building }}</td>
                        <td>{{ $inspection->weather }}</td>
                        <td>{{ $inspection->temperature }}</td>

                        <td>
                            <a href="{{ $inspection->path() }}">View</a>
                            <a
                                href="{{ $inspection->path() . '/edit' }}"
                            >Edit</a>
                            <a
                                href="{{ $inspection->path() }}"
                                class="text-red-500"
                                onclick="event.preventDefault();
                                    document.getElementById('{{ 'delete-inspection-' . $inspection->id }}').submit();"
                            >Delete</a>
                            <form id="{{ 'delete-inspection-' . $inspection->id }}" action="{{ $inspection->path() }}" method="POST" class="hidden">
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
