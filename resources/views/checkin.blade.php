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
    <h3>リソース</h3>
    <ul>
        <li><a href="{{ route('events.show', [$event->uuid]) }}">イベント詳細</a></li>
        <li><a href="{{ route('participants.index', ['event_id' => $event->uuid]) }}">参加者一覧</a></li>
    </ul>
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
