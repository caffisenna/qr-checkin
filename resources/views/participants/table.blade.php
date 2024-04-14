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
                    <th colspan="3">操作</th>
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
                                済 <span class="uk-text-small uk-text-danger">[取消]</span>
                            @else
                                <form
                                    action="{{ route('checkin', ['bsid' => $participants->bsid, 'event_id' => $participants->event->uuid, 'redirect' => 'true']) }}"
                                    method="POST" onsubmit="return confirm('チェックインしてよろしいですか?');">
                                    @csrf
                                    <button type="submit" class="uk-button uk-button-primary">IN!</button>
                                </form>
                            @endif
                        </td>
                        <td style="width: 120px">
                            {!! Form::open(['route' => ['participants.destroy', $participants->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{{ route('participants.edit', [$participants->id]) }}"
                                    class='btn btn-default btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('本当に削除しますか?')",
                                ]) !!}
                            </div>
                            {!! Form::close() !!}
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
