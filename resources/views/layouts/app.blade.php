<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/validation.js') }}" defer></script>
    <script src="{{ asset('js/header.js') }}" defer></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.33.7/js/dropin.min.js"></script>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--tom tom -->
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>

</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <nav class="bg-brand-500 shadow mb-8 py-6">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-between">
                    <div class="mr-6">
                        <a href="/" class="text-lg relative brand-logo font-bold text-white capitalize no-underline">airbnb</a>
                    </div>

                    {{-- HEADER FULLWIDTH --}}
                    <div class="hidden lg:flex gap-3 space-between items-center text-right ali">
                        @guest
                            <a class="no-underline hover:underline text-white text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline hover:underline text-white text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            @if(Route::currentRouteName() != 'admin.apartments.index')
                                <a class="text-white mr-5" href="{{ route('admin.apartments.index')}}">I miei appartamenti</a>    
                            @endif
                            <div>
                                <a class="text-white flex items-center" href="{{ route('admin.users.show', Auth::user())}}">
                                    <span class="text-sm pr-4">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
                                    @if(auth::user()->profile_pic)
                                        <img class="w-10 h-10 rounded-full object-cover" src="{{ auth::user()->profile_pic_path }}" alt="">
                                    @else 
                                        <img class="w-10 h-10 rounded-full object-cover" src="https://cdn-icons-png.flaticon.com/512/1144/1144709.png" alt="">
                                    @endif
                                </a>
                            </div>
                            <a href="{{ route('logout') }}"
                               class="no-underline hover:underline text-white text-sm p-3"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>


                    {{-- DROPDOWN MENU --}}
                    <div class="humburger  flex lg:hidden flex-col gap-2">
                        <span class="bar"></span>
                    </div>

                    <div class="drop_menu lg:hidden translate-x flex text-white fixed  justify-center items-center">
                        <div class="links_wrapper flex flex-col gap-4">


                            @guest
                                <a class="no-underline hover:underline text-white text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                    <a class="no-underline hover:underline text-white text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                                @else
                                @if(Route::currentRouteName() != 'admin.apartments.index')
                                    <a class="text-white text-xl font-bold" href="{{ route('admin.apartments.index')}}">I miei appartamenti</a>    
                                @endif

                                @if (Route::currentRouteName() != 'admin.users.show')
                                    
                                    <div class="text-center">
                                        <a class="text-white flex flex-col text-center items-center" href="{{ route('admin.users.show', Auth::user())}}">
                                            <img style="width: 40px; height: 40px; border-radius: 50%;"  class="items-center" src="{{ auth::user()->profile_pic_path }}" alt="">
                                            <span class="text-xl  font-bold">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
                                            @if(auth::user()->profile_pic)
                                            @endif
                                        </a>
                                    </div>
                                @endif


                                <a href="{{ route('logout') }}"
                                    class="no-underline hover:underline text-xl text-center font-bold text-white"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            @endguest


                        </div>
                    </div>

                </div>
            </div>
        </nav>

        @yield('content')
    </div>
</body>
</html>
