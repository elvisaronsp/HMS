@extends('layouts.app')

@section('nav')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light shadow-sm" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/"><i class="flaticon-pharmacy"></i><span></span>HMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="/user/dashboard" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="/user/appointments" class="nav-link">Appointments</a></li>
                    <li class="nav-item"><a href="departments.html" class="nav-link">Departments</a></li>
                    <li class="nav-item"><a href="doctor.html" class="nav-link">Doctors</a></li>
                    <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                    <li class="nav-item cta">
                        <a href="{{ route('logout') }}"
                           class="nav-link"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <span>Log out</span>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- another nav -->
{{--    <nav class="navbar navbar-expand-md navbar-light navbar-laravel shadow-sm p-3 mb-5 bg-white">--}}
{{--    <div class="container">--}}

{{--        @if(Auth::guard('web')->check())--}}
{{--            <a class="navbar-brand" href="{{ url('/user/dashboard') }}">--}}
{{--                Dashboard--}}
{{--            </a>--}}
{{--            <a class="navbar-brand" href="{{ url('/user/appointments') }}">--}}
{{--                Appointment--}}
{{--            </a>--}}
{{--        @endif--}}
{{--        --}}
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}

{{--        <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--            <!-- Left Side Of Navbar -->--}}
{{--            <ul class="navbar-nav mr-auto">--}}
{{--            </ul>--}}
{{--            <!-- Right Side Of Navbar -->--}}
{{--            <ul class="navbar-nav ml-auto">--}}
{{--                <!-- Authentication Links -->--}}
{{--                @auth--}}
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                            {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                        </a>--}}

{{--                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}

{{--                            @if(Auth::guard('web')->check())--}}
{{--                                <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}

{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            @elseif(Auth::guard('doctor')->check())--}}
{{--                                <a class="dropdown-item" href="{{ route('doctor.logout') }}"--}}
{{--                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}

{{--                                <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST" style="display: none;">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @else--}}

{{--                @endauth--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </nav>--}}
@endsection

@section('content')

        @yield('content')

@endsection