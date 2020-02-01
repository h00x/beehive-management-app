@extends('layouts.app')

@section('content')
<div>
    <div>
        <div>
            <div>
                <div class="font-title text-3xl text-gray-900">Dashboard</div>

                <div>
                    @if (session('status'))
                        <div role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
