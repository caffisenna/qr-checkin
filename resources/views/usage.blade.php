<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap4-toggle.min.css') }}" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}" />

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('css/icheck-bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" />

    @stack('third_party_stylesheets')
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ asset('/uikit/uikit.min.css') }}" />

    {{-- my css --}}
    <link rel="stylesheet" href="{{ asset('/css/my_css.css') }}" />

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    @stack('datatables_scripts')
    {{-- <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script> --}}

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <h2>使い方</h2>
            </section>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">

        </footer>
    </div>


    <script src="{{ asset('js/popper.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/bs-custom-file-input.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>

    <script src="{{ asset('js/moment.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script>

    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script src="{{ asset('js/bootstrapSwitch.min.js') }}"></script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>

    @stack('third_party_scripts')
    <!-- UIkit JS -->
    <script src="{{ asset('/js/uikit.min.js') }}"></script>
    <script src="{{ asset('/js/uikit-icons.min.js') }}"></script>
    @stack('page_scripts')
</body>

</html>
