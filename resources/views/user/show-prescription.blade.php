@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow" style="padding: 40px;">
                    <div class="card body">
                        <h3>Your Prescription</h3>
                        <p style="margin: 0">
                            Dr {{ $prescription->appointment->doctor->name }} 
                            {{ $prescription->appointment->doctor->surname }}, 
                            {{ $prescription->appointment->doctor->specialty->title }}
                        </p>
                        <p>Visited on {{ \Carbon\Carbon::parse($prescription->appointment->date)->format('jS \o\f F Y') }}</p>
                    </div>

                    <div class="diagnosis-heading">
                        <h4>Diagnosis<h4>
                    </div>
                    <p>{{ $prescription->diagnosis }}</p>

                     <div class="treatment-heading">
                        <h4>Treatment<h4>
                    </div>
                    <p>{{ $prescription->treatment }}</p>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection