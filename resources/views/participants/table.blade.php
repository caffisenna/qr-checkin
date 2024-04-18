<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="participants-table">
            <thead>
                <tr>
                    <th>氏名</th>
                    <th>県連</th>
                    <th>地区</th>
                    <th>役務</th>
                    <th>イベント</th>
                    <th>チェックイン</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participants as $participants)
                    <tr>
                        <td><a href="{{ route('participants.show', [$participants->uuid]) }}"
                                class=''>{{ $participants->name }}
                            </a></td>
                        <td>{{ $participants->prefecture }}</td>
                        <td>{{ $participants->district }}</td>
                        <td>{{ $participants->role }}</td>
                        <td><a
                                href="{{ route('events.show', ['event' => $participants->event_id]) }}">{{ $participants->event->name }}</a>
                        </td>
                        <td>
                            @if ($participants->checked_in_at)
                                済
                            @else
                                <form
                                    action="{{ route('checkin', ['bsid' => $participants->bsid, 'event_id' => $participants->event->uuid, 'redirect' => 'true']) }}"
                                    method="POST" onsubmit="return confirm('チェックインしてよろしいですか?');">
                                    @csrf
                                    <button type="submit" class="uk-button uk-button-primary">IN!</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            {{-- @include('adminlte-templates::common.paginate', ['records' => $participants]) --}}
        </div>
    </div>
</div>
