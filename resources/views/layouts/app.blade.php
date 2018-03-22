<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panda School – Школа онлайн</title>
    <!--	<meta name="viewport" content="width=device-width, initial-scale=1">-->

    @yield('styles')
    <link rel="stylesheet" href="{{ asset('design/css/main.css')  }}">
</head>
<body>

<div class="dashboard" id="app">

    <header>
        <div class="panel">
            <div class="container panel__contaner">
                <div class="logo">
                    <a href="{{ route('dashboard.home') }}" class="logo__link">
                        <img src="{{ asset('design/images/logo.png') }}" srcset="{{ asset('design/images/logo@2x.png') }} 2x" alt="">
                    </a>
                </div>
                <div class="panel__control">
                    <!-- Languages -->



                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <script src="{{ asset('design/js/lib.js') }}"></script>
    <script src="{{ asset('design/js/main.js') }}"></script>

@yield('scripts')


</body>
</html>