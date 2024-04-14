@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ダウンロード</h2>
        </div>
    </div>
    <ul>
        <li><a href="{{ asset('download/participants_template.xlsx') }}">参加者一括登録用テンプレート(xlsx)</a></li>
    </ul>
@endsection
