@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/dataTables.dataTables.min.css') }}">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>参加者</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="{{ route('participants.create') }}">
                        追加
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('participants.table')
        </div>
    </div>

    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script>
        let table = new DataTable('#participants-table');
    </script>
@endsection
