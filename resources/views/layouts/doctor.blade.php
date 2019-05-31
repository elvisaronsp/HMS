@extends('layouts.app')

@section('nav')
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light shadow p-3 mb-5" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/"><i class="flaticon-pharmacy"></i><span></span>HMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="/doctor/dashboard" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="/doctor/appointments" class="nav-link">Appointments</a></li>
                    <li class="nav-item"><a href="/doctor/appointments/archive" class="nav-link">Archive</a></li>
                    <li class="nav-item"><a href="doctor.html" class="nav-link">Consult</a></li>
                    <li class="nav-item cta">
                        <a href="{{ route('doctor.logout') }}"
                           class="nav-link"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <span>Log out</span>

                            <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST" style="display: none;">
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