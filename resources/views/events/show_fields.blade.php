<table class="uk-table uk-table-striped">
    <tr>
        <th>カテゴリ</th>
        <td>{{ $events->category }}</td>
    </tr>
    <tr>
        <th>イベント名</th>
        <td>{{ $events->name }}</td>
    </tr>
    <tr>
        <th>開催日</th>
        <td>{{ $events->date->format('Y-m-d') }}</td>
    </tr>
    <tr>
        <th>申込人数</th>
        <td>{{ $totalMembersCount }} 人</td>
    </tr>
    <tr>
        <th>チェックイン人数</th>
        <td>{{ $checkedInCount }}人</td>
    </tr>
    <tr>
        <th>イベントID</th>
        <td>{{ $events->uuid }}</td>
    </tr>
    <tr>
        <th>県連</th>
        <td>{{ $events->prefecture }}</td>
    </tr>
    <tr>
        <th>地区</th>
        <td>{{ $events->district }}</td>
    </tr>
    <tr>
        <th>イベント作成日</th>
        <td>{{ $events->created_at }}</td>
    </tr>
    <tr>
        <th>イベント更新日</th>
        <td>{{ $events->updated_at }}</td>
    </tr>
    <tr>
        <th>export</th>
        <td><a href="{{ route('export_members', ['event_id' => $events->uuid]) }}" class="uk-button uk-button-default">
                <span uk-icon="icon: download"></span> export</a>
        </td>
    </tr>
    <tr>
        <th>編集</th>
        <td><a href="{{ route('events.edit', [$events->id]) }}" class='uk-button uk-button-default'>
                <span uk-icon="icon: file-edit"></span>編集
            </a></td>
    </tr>
    <tr>
        <th>削除</th>
        <td>{!! Form::open(['route' => ['events.destroy', $events->id], 'method' => 'delete']) !!}
            {!! Form::button('<span uk-icon="icon: trash"></span>削除', [
                'type' => 'submit',
                'class' => 'uk-button uk-button-danger',
                'onclick' => "return confirm('本当に削除しますか?')",
            ]) !!}

            {!! Form::close() !!}</td>
    </tr>
</table>
