<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="events-table">
            <thead>
                <tr>
                    <th>カテゴリ</th>
                    <th>イベント</th>
                    <th>開催日</th>
                    <th>県連</th>
                    <th>地区</th>
                    <th colspan="3">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $events)
                    <tr>
                        <td>{{ $events->category }}</td>
                        <td><a href="{{ route('events.show', [$events->uuid]) }}" class=''>{{ $events->name }}</a>
                        </td>
                        <td>{{ $events->date->format('Y-m-d') }}</td>
                        <td>{{ $events->prefecture }}</td>
                        <td>{{ $events->district }}</td>
                        <td style="width: 120px">
                            {!! Form::open(['route' => ['events.destroy', $events->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{{ route('events.edit', [$events->id]) }}" class='btn btn-default btn-xs'>
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
            {{-- @include('adminlte-templates::common.paginate', ['records' => $events]) --}}
        </div>
    </div>
</div>
