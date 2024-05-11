<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QRチェックイン</title>

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('uikit/uikit.min.css') }}">
</head>

<body>
    <div
        class="relative items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">ログイン</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">ユーザー登録</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="uk-height-large uk-background-cover uk-overflow-hidden uk-light uk-flex"
            style="background-image: url('images/top_image.jpg');">
            <div class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical">
                <h1 uk-parallax="opacity: 0,1; y: -100,0; scale: 2,1; end: 50vh + 50%;">Scan your MyPage QR - check
                    in with ease</h1>
                <p uk-parallax="opacity: 0,1; y: 100,0; scale: 0.5,1; end: 50vh + 50%;">QRコードでチェックインしよう!</p>
                @auth
                    <a href="{{ url('/home') }}" class="">Home</a>
                @else
                    <a href="{{ route('login') }}" class="uk-button uk-button-primary">ログイン</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="uk-button uk-button-primary">ユーザー登録</a>
                    @endif
                @endauth
                <a href="{{ route('usage') }}"
                            class="uk-button uk-button-primary">使い方ガイド</a>

                {{-- <a href="{{ route('register') }}" class="uk-button uk-button-primary">新規登録</a>
                <a href="#" class="uk-button uk-button-primary">ログイン</a> --}}
            </div>
        </div>


        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 sm:text-left">
                <div class="flex items-center">



                </div>
            </div>

            <footer class="main-footer">
                ボーイスカウト日本連盟 DXタスクチーム
            </footer>
        </div>

    </div>
</body>

</html>
