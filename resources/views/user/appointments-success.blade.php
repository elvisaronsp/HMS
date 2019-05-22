@extends('layouts.user')

@section('content')
    <div class="container">
        <h1>Reservation has been completed!</h1>
        <h2>You made reservation on {{ $reservation->date }} at {{ $reservation->time }}</h2>
    </div>
@endsection