@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2><span uk-icon="icon: download"></span>ダウンロード</h2>
        </div>
    </div>
    <ul>
        <li><a href="{{ asset('download/participants_template.xlsx') }}">参加者一括登録用テンプレート(xlsx形式)</a></li>
    </ul>
@endsection
