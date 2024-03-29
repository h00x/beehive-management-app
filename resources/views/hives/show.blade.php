@extends('layouts.app')

@section('pageTitle', trans_choice('hives.hive', 1) . ': ' . $hive->name)

@section('overviewUrl', route('hives.index'))

@section('headerButton')
    @include('layouts.button', ['text' => __('hives.edit'), 'url' => $hive->path() . '/edit'])
@endsection

@section('deleteLink')
    <dropdown align="right" margin="0">
        <template v-slot:trigger>
            <button class="text-sm text-gray-500 z-20 dots hover:text-gray-700"><i class="fas fa-ellipsis-h"></i></button>
        </template>
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
@stop

@section('content')
    @if($hive->image)
        <div class="w-auto h-48 bg-no-repeat bg-cover bg-center mb-12" style="background-image: url('{{ Storage::url('images/hives/'.$hive->image.'.jpg') }}')"></div>
    @endif
    <div class="flex">
        <div class="w-2/3">
            <table class="w-full mb-12">
                <tr>
                    <td class="p-2">{{ trans_choice('hivetypes.type', 1) }}</td>
                    <td class="p-2">{{ $hive->type->name }}</td>
                </tr>
                <tr class="bg-white">
                    <td class="p-2">{{ trans_choice('queens.queen', 1) }}</td>
                    <td class="p-2">{{ $hive->queen->name }} <small><a href="{{ $hive->queen->path() . '/edit' }}">@lang('queens.edit')</a></small></td>
                </tr>
                <tr>
                    <td class="p-2">@lang('hives.created')</td>
                    <td class="p-2">{{ Carbon\Carbon::parse($hive->created_at)->format('d-m-Y') }}</td>
                </tr>
                <tr class="bg-white">
                    <td class="p-2">@lang('hives.updated')</td>
                    <td class="p-2">{{ Carbon\Carbon::parse($hive->updated_at)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td class="p-2">{{ trans_choice('apiaries.apiary', 1) }}</td>
                    <td class="p-2"><a href="{{ $hive->apiary->path() }}">{{ $hive->apiary->name }}</a></td>
                </tr>
                <tr class="bg-white">
                    <td class="p-2">@lang('general.location')</td>
                    <td class="p-2">{{ $hive->apiary->location }}</td>
                </tr>
                <tr>
                    <td class="p-2">@lang('hives.harvested')</td>
                    <td class="p-2">{{ array_sum($hive->harvests->pluck('weight')->toArray()) }}</td>
                </tr>
            </table>

            <div class="flex justify-between mb-4">
                <h2 class="text-3xl">Inspections</h2>
                @include('layouts.button', ['text' => 'Log a inspection', 'url' => route('inspections.create', ['hivePreviousPage' => $hive->id])])
            </div>
            <table class="w-full mb-12">
                <thead>
                    <tr class="text-left">
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
                @foreach ($hive->inspections as $inspection)
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">{{ Carbon\Carbon::parse($inspection->date)->format('d-m-Y') }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $inspection->queen_seen ? 'Yes' : 'No' }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $inspection->larval_seen ? 'Yes' : 'No' }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $inspection->young_larval_seen ? 'Yes' : 'No' }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $inspection->pollen_arriving }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $inspection->comb_building }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $inspection->weather }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $inspection->computed_temperature }}</td>
                        <td class="border border-gray-200 px-4 py-2"><a href="{{ $inspection->path() }}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="flex justify-between mb-4">
                <h2 class="text-3xl">Harvests</h2>
                @include('layouts.button', ['text' => 'Log a harvest', 'url' => route('harvests.create', ['hivePreviousPage' => $hive->id])])
            </div>
            <table class="w-full">
                <thead>
                    <tr class="text-left">
                        <th>Name</th>
                        <th>Harvest date</th>
                        <th>Batch code</th>
                        <th>Weight</th>
                        <th>Moister content</th>
                        <th>Nectar source</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($hive->harvests as $harvest)
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">{{ $harvest->name }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $harvest->date }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $harvest->batch_code }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $harvest->computed_weight }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $harvest->moister_content }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $harvest->nectar_source }}</td>
                        <td class="border border-gray-200 px-4 py-2"><a href="{{ $harvest->path() }}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-1/3 ml-6">
            <ul class="text-xs">
                @foreach($hive->activities->reverse() as $activity)
                    <li class="{{ $loop->last ? '' : 'pb-2' }}">
                        {{ $activity->causer->first_name }} {{ $activity->description }} {{ $activity->subject->name }}
                        <small>{{ $activity->created_at->diffForHumans() }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
