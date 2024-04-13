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
                        <td>
                            @foreach ($events as $event)
                                @if ($event->uuid === $participants->event_id)
                                    {{ $event->name }}
                                @endif
                            @endforeach
                            {{-- {{ $participants->event_id }} --}}
                        </td>
                        <td>
                            @if ($participants->checked_in_at)
                                済
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
