@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>確認: {{ $event->name }}</h2>
        </div>
    </div>
    @include('flash::message')

    @if (isset($user))
        <table class="uk-table uk-table-striped uk-text-large">
            <tr>
                <th>チェックイン</th>
                <td>{{ $user->checked_in_at }}</td>
            </tr>
            <tr>
                <th>氏名</th>
                <td>{{ $user->name }} ({{ $user->furigana }})</td>
            </tr>
            <tr>
                <th>登録番号</th>
                <td>{{ $user->bsid }}</td>
            </tr>
            <tr>
                <th>所属</th>
                <td>{{ $user->prefecture }} {{ $user->district }} {{ $user->role }}</td>
            </tr>
            <tr>
                <th>自由欄1</th>
                <td>{{ $user->field1 }}</td>
            </tr>
            <tr>
                <th>自由欄2</th>
                <td>{{ $user->field2 }}</td>
            </tr>
            <tr>
                <th>自由欄3</th>
                <td>{{ $user->field3 }}</td>
            </tr>
            <tr>
                <th>チェックイン取消</th>
                <td><a href="{{ route('revert', ['id' => $user->bsid, 'event_id' => $event->uuid]) }}"
                        class="uk-button uk-button-danger" onclick="return confirmRevert()">取消</a></td>
            </tr>
        </table>
    @endif
    <div>
        <a href="{{ route('checkin', ['event_id' => $event->uuid]) }}"
            class="uk-button uk-button-primary uk-button-large">確認</a>
    </div>
@endsection

<script>
    function confirmRevert() {
        return confirm('チェックインを取り消しますか?');
    }
</script>
