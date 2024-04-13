@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        イベント詳細
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('events.index') }}">
                        戻る
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('events.show_fields')
                </div>
            </div>
        </div>
    </div>
    <ul>
        <li><a href="{{ route('checkin', ['event_id' => $events->uuid]) }}">チェックイン</a></li>
        <li><a href="{{ route('participants.index', ['event_id' => $events->uuid]) }}">参加者一覧</a></li>
        <li><a href="{{ route('upload_view', ['event_id' => $events->uuid]) }}">参加者登録</a></li>
    </ul>
@endsection
