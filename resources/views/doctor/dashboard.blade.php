@extends('layouts.doctor')

@section('content')
    <div class="container">
        <div class="row">

            <div class="shadow-lg dashboard-card">
                <h3 class="heading">Upcoming Appointment<h3>

                @if($upcomingAppointment)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ $upcomingAppointment->user->avatar }}" class="card-img" style="border-radius: 50%;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="margin-left: 15px;">
                                    <h5 class="card-title">
                                        Patient
                                    </h5>

                                    <p class="card-text">
                                        {{ $upcomingAppointment->user->name }} {{ $upcomingAppointment->user->surname }}
                                    </p>

                                    <p class="card-text appointment-time">
                                        {{ \Carbon\Carbon::parse($upcomingAppointment->date)->format('jS \o\f F Y') }}
                                    </p>

                                    <p class="card-text appointment-date">
                                        {{ Str::limit($upcomingAppointment->time, 5, '') }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                @else 
                    <div class="row justify-content-center">
                        <img src="/images/appointment-empty.png" height="250px" width="400px">
                        <p style="color: #546E7A">You don't have appointments yet</p>
                    </div>
                @endif
            </div>

            <div class="shadow-lg patient-profile-card">
                <div class="patient-profile-wrapper" >
                    <h3>Patient Profile</h3>
                    @if($upcomingAppointment)
                        <p>Age</p>
                        <div class="border patient-profile-info">
                            {{ \Carbon\Carbon::now()->diffInYears($upcomingAppointment->user->birthday) }}
                        </div>

                        <p>Gender</p>
                        <div class="border patient-profile-info">
                            {{ $upcomingAppointment->user->gender }}
                        </div>

                        <p>Phone</p>
                        <div class="border patient-profile-info">
                            {{ $upcomingAppointment->user->phone }}
                        </div>
                    @endif

                    <!-- TODO: empty state -->
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('js')
<script>

</script>
@endsection