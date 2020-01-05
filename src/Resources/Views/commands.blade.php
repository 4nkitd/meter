@extends('meter::layout.layout')

@section('content')

    <ul class="nav nav-tabs justify-content-center">
        <li class="nav-item">
            <a class="nav-item nav-link active" data-toggle="tab" href="#graph">Graph</a>
        </li>
        <li class="nav-item">
            <a class="nav-item nav-link" data-toggle="tab" href="#index">Commands</a>
        </li>
    </ul>

    <div class="tab-content bg-white p-4">

        @include('meter::layout.filters', ['route' => 'meter_commands'])

        <div class="tab-pane fade show active" role="tabpanel" id="graph">
            <div class="text-center text-primary"><strong>Commands Per Day</strong></div>
            <div>{!! $chart->container() !!}</div>
        </div>

        <div class="tab-pane fade" role="tabpanel" id="index">
            <div class="table-responsive-sm">
                <table class="meter_table table table-hover mx-auto w-100">
                    <thead>
                    <tr>
                        <th>Happened</th>
                        <th>Command</th>
                        <th>Exit Code</th>
                        <th>More</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('js')

    {!! $chart->script() !!}

    <script>

        meterTable('.table', '{{ route('meter_commands_table') }}', 25, [
            {data: 'Happened'},
            {data: 'Command'},
            {data: 'Exit Code'},
            {data: 'More'},
        ], {
            "columnDefs": [
                {"width": "10%", "targets": -1}
            ]
        }, {
            {{request()->has('days') ? 'days : ' . request()->days : ''}}
            {{request()->has('slow') ? 'slow : 1' : ''}}
            {{request()->has('all') ? 'all : 1' : ''}}
        });

    </script>
@endpush
