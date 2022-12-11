<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!--tom tom -->

</head>
<body class="bg-gray-100 text-gray-500 md:pb-20 text-base antialiased leading-none">
    @php
        $user = Auth::check() ? Auth::user() : null;
    @endphp

    <div id="app"></div>

     <!-- Scripts -->
     <script src="{{ asset('js/front.js') }}" defer></script>
     <script>
        window.user = @json($user)
     </script>
</body>
</html>
