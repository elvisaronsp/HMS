@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row">

            <div class="shadow-lg dashboard-card">
                <h3 class="heading">Upcoming Appointment<h3>

                @if($upcomingAppointment)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ $upcomingAppointment->doctor->image }}" class="card-img" style="border-radius: 50%;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="margin-left: 15px;">
                                    <h5 class="card-title">
                                        {{ $upcomingAppointment->doctor->specialty->title }}
                                    </h5>

                                    <p class="card-text">
                                        {{ $upcomingAppointment->doctor->name }} {{ $upcomingAppointment->doctor->surname }}
                                    </p>

                                    <p class="card-text appointment-time">
                                        {{ \Carbon\Carbon::parse($upcomingAppointment->date)->format('jS \o\f F Y')  }}
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

            <div class="shadow-lg calendar-card">
                <div id="caleandar"></div>
            </div>
            
        </div>
    </div>
@endsection

@section('js')
<script>
    $( document ).ready(function() {
        let events = []
        
        let userDates = {!! $futureAppointments !!}

        userDates.forEach(element => {
            console.log(moment(element.date))
            events.push({ 
                Date: new Date(moment(element.date)),
                Title: 'Doctor appointment at ' + element.time.substring(0, 5),
                Link: "https://hms.test"
            })
        });
        
    
    var settings = {};
    var element = document.getElementById("caleandar");
    caleandar(element, events, settings);
});
</script>
@endsection