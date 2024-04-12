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
</table>
