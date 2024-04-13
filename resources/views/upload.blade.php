@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>イベント名: {{ $event->name }}</h2>
        </div>
    </div>
    <p>参加者情報の入力されたエクセルファイルをアップロードして一括登録します。(ファイルサイズ最大2MB)</p>
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".xlsx, .csv" class="uk-input">
        {!! Form::hidden('event_id', $event->uuid) !!}
        <button type="submit" class="uk-button uk-button-primary">アップロード</button>
    </form>
@endsection
