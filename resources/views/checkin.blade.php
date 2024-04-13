@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>チェックイン: {{ $event->name }}</h2>
        </div>
    </div>
    <form action="{{ route('checkin') }}" method="POST">
        @csrf
        <input type="text" name="bsid" id="bsid" class="uk-input uk-form-large">
        {!! Form::hidden('event_id', $event->uuid) !!}
    </form>

    @if (isset($user))
        <h2 class="uk-text-success">チェックイン完了!</h2>
        <table class="uk-table uk-table-striped">
            <tr>
                <th>お名前</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>登録番号</th>
                <td>{{ $user->bsid }}</td>
            </tr>
            <tr>
                <th>県連盟</th>
                <td>{{ $user->prefecture }} {{ $user->district }}</td>
            </tr>
            <tr>
                <th>役務</th>
                <td>{{ $user->role }}</td>
            </tr>
            <tr>
                <th>その他</th>
                <td>
                    @if ($user->field1)
                        {{ $user->field1 }}
                    @endif
                    {{ $user->field1 }}
                    @if ($user->field2)
                        <br>{{ $user->field2 }}
                    @endif
                    @if ($user->field3)
                        <br>{{ $user->field3 }}
                    @endif
                </td>
            </tr>
        </table>
    @endif
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var bsidInput = document.getElementById('bsid');
        bsidInput.focus();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var bsidInput = document.getElementById('bsid');
        bsidInput.addEventListener('input', function() {
            var inputValue = bsidInput.value;
            if (inputValue.startsWith('saj://') && inputValue.length === 17) {
                // 11桁の整数が入力されたら
                bsidInput.form.submit();
            }
        });
        bsidInput.focus();
    });
</script>
