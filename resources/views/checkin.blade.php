@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>チェックイン: {{ $event->name }}</h2>
        </div>
    </div>
    @include('flash::message')
    <form action="{{ route('checkin') }}" method="POST">
        @csrf
        <input type="text" name="bsid" id="bsid" class="uk-input uk-form-large" onkeyup="validateAndSubmit(this)">
        {!! Form::hidden('event_id', $event->uuid) !!}
    </form>

    @if (isset($user))
        @unless ($user->checked_in_at)
            <h2 class="uk-text-success">チェックイン完了!</h2>
        @else
            <h2 class="uk-text-warning">重複チェックインです</h2>
            <p class="uk-text-default">前回のチェックイン時刻: {{ $user->checked_in_at }}</p>
        @endunless

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

        bsidInput.addEventListener('blur', function() {
            bsidInput.focus();
        });

        bsidInput.addEventListener('input', function() {
            var inputValue = bsidInput.value;

            if (inputValue.startsWith('saj://') && inputValue.length === 17) {
                bsidInput.form.submit();
            }
        });
    });

    // auto submit
    function validateAndSubmit(input) {
        const value = input.value;
        const lastDigits = value.slice(-11);

        if (/^\d{11}$/.test(lastDigits)) {
            input.form.submit();
        }
    }
</script>
