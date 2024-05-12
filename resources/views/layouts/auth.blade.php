<!DOCTYPE html>

<html lang="en" class="customizer-hide">

<head>
    <meta charset="utf-8" />
    <title>Thekuchel Admin - @yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Thekuchel">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Si Paling Programmer Kuchel">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.9.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.9.1') }}">

    <script src="{{ asset('assets/js/libs/jquery/jquery.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <!-- Content -->
    @yield('main-content')

    <!-- JavaScript -->
    <script src="{{ asset('assets/js/bundle.js?ver=2.9.1') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=2.9.1') }}"></script>

</body>

</html>
