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
@endsection

@section('content')
        @yield('content')
@endsection

