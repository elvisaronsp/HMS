@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card wrapper-card shadow">
                    <h3>Free Doctors & Times for {{ \Carbon\Carbon::create($queryDate)->toFormattedDateString() }}</h3>

                    <form method="POST" action="{{ route('user.make.reservation') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="doctor_id" class="hidden-doctor-input">
                        <input type="hidden" name="date" value="{{ $queryDate }}">

                        @if ($doctorsWithFreeHours)
                            @foreach($doctorsWithFreeHours as $doctor)
                                <div class="card-body" id="{{ $doctor['id'] }}">
                                    <p>
                                        <a href="{{ url('doctor/profile/' . $doctor['id']) }}" target="_blank" style="color:#39345A">
                                            {{ $doctor['name'] }} {{ $doctor['surname'] }}
                                        </a>
                                    </p>

                                    @if(count($doctor['freeHours']) == 0)
                                        <i class="far fa-calendar-times" style="font-size: 2em;"></i>

                                    @else

                                        @foreach($doctor['freeHours'] as $freeHour)
                                            <div class="free-hour button">
                                                <input type="radio" class="appoint-radio" name="freeHour" value="{{ $freeHour }}" id="{{ $doctor['id'] }}{{ $loop->iteration }}" />

                                                <div class="time card shadow-sm">
                                                    <label class="free-hour-label" for="{{ $doctor['id'] }}{{ $loop->iteration }}">
                                                        {{ Str::limit($freeHour, 5, '') }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach

                                    @endif
                                </div>
                            @endforeach
                        @else
                            <h4>Sorry, free doctor was not found</h4>
                        @endif

                        <input type="submit" name="submit" value="Reserve" class="btn btn-danger reserve-btn"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
