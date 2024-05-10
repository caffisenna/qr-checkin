<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="participants-table">
            <thead>
                <tr>
                    <th>氏名</th>
                    <th>県連</th>
                    <th>団</th>
                    <th>役務</th>
                    <th>イベント</th>
                    <th>チェックイン</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td><a href="{{ route('participants.show', [$participant->uuid]) }}"
                                class=''>{{ $participant->name }}
                            </a>
                            @if ($participant->furigana)
                                <br>{{ $participant->furigana }}
                            @endif
                            @if ($participant->bsid)
                                <br>{{ $participant->bsid }}
                            @endif
                        </td>
                        <td>{{ $participant->prefecture }}</td>
                        <td>{{ $participant->district }}</td>
                        <td>{{ $participant->role }}</td>
                        <td><a
                                href="{{ route('events.show', ['event' => $participant->event_id]) }}">{{ $participant->event->name }}</a>
                        </td>
                        <td>
                            @if ($participant->checked_in_at)
                                済
                            @else
                                <form
                                    action="{{ route('checkin', ['bsid' => $participant->bsid, 'event_id' => $participant->event->uuid, 'redirect' => 'true']) }}"
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
