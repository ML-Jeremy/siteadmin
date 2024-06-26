@extends('simple-user.app')

@section('auth')


    @if(\Request::is('static-sign-up'))
        @include('simple-user.navbars.guest.nav')
        @yield('content')
        @include('simple-user.footers.guest.footer')

    @elseif (\Request::is('static-sign-in'))
        @include('simple-user.navbars.guest.nav')
            @yield('content')
        @include('simple-user.footers.guest.footer')

    @else
        @if (\Request::is('rtl'))
            @include('simple-user.navbars.auth.sidebar-rtl')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg overflow-hidden">
                @include('simple-user.navbars.auth.nav-rtl')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('simple-user.footers.auth.footer')
                </div>
            </main>

        @elseif (\Request::is('profile'))
            @include('simple-user.navbars.auth.sidebar')
            <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
                @include('simple-user.navbars.auth.nav')
                @yield('content')
            </div>

        @elseif (\Request::is('virtual-reality'))
            @include('simple-user.navbars.auth.nav')
            <div class="border-radius-xl mt-3 mx-3 position-relative" style="background-image: url('../assets/img/vr-bg.jpg') ; background-size: cover;">
                @include('simple-user.navbars.auth.sidebar')
                <main class="main-content mt-1 border-radius-lg">
                    @yield('content')
                </main>
            </div>
            @include('simple-user.footers.auth.footer')

        @else
            @include('simple-user.navbars.auth.sidebar')
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
                @include('simple-user.navbars.auth.nav')
                <div class="container-fluid py-4">
                    @yield('content')
                    @include('simple-user.footers.auth.footer')
                </div>
            </main>
        @endif

        @include('components.fixed-plugin')
    @endif



@endsection
