<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="events-table">
            <thead>
                <tr>
                    <th>カテゴリ</th>
                    <th>イベント</th>
                    <th>開催日</th>
                    <th>人数</th>
                    <th>県連</th>
                    <th>地区</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $events)
                    <tr>
                        <td>{{ $events->category }}</td>
                        <td><a href="{{ route('events.show', [$events->uuid]) }}" class=''>{{ $events->name }}</a>
                        </td>
                        <td>{{ $events->date->format('Y-m-d') }}</td>
                        <td>
                            @foreach ($participantCounts as $count)
                                @if ($count->event_id === $events->uuid)
                                    {{ $count->count }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $events->prefecture }}</td>
                        <td>{{ $events->district }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            {{-- @include('adminlte-templates::common.paginate', ['records' => $events]) --}}
        </div>
    </div>
</div>
