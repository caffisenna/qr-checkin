<table class="uk-table uk-table-striped">
    <tr>
        <th>イベント名</th>
        <td>{{ $participants->event->name }}</td>
    </tr>
    <tr>
        <th>氏名</th>
        <td>{{ $participants->name }}</td>
    </tr>
    <tr>
        <th>登録番号</th>
        <td>{{ $participants->bsid }}</td>
    </tr>
    <tr>
        <th>県連・地区</th>
        <td>{{ $participants->prefecture }} {{ $participants->district }}</td>
    </tr>
    <tr>
        <th>役務</th>
        <td>{{ $participants->role }}</td>
    </tr>

    @php
        $fields = [
            ['label' => '自由フィールド1', 'value' => $participants->field1],
            ['label' => '自由フィールド2', 'value' => $participants->field2],
            ['label' => '自由フィールド3', 'value' => $participants->field3],
        ];
    @endphp

    @foreach ($fields as $field)
        <tr>
            <th>{{ $field['label'] }}</th>
            <td>{{ $field['value'] }}</td>
        </tr>
    @endforeach

    <tr>
        <th>チェックイン</th>
        <td>
            @if (isset($participants->checked_in_at))
                {{ $participants->checked_in_at->format('Y-m-d') }}
            @else
                <a href="#" class="uk-button uk-button-primary">IN!</a>
            @endif
        </td>
    </tr>
    <tr>
        <th>個人識別ID</th>
        <td>{{ $participants->uuid }}</td>
    </tr>
</table>
