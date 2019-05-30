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

                        @foreach($doctorsWithFreeHours as $doctor)
                            <div class="card-body" id="{{ $doctor['id'] }}">
                                <p>{{ $doctor['name'] }} {{ $doctor['surname'] }}</p>

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
                            </div>
                        @endforeach

                        <input type="submit" name="submit" value="Reserve" class="btn btn-danger reserve-btn"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection