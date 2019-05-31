@extends('layouts.doctor')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <div class="card shadow" style="padding: 40px;">
                    <div class="card body">
                        <h3>Create Prescription</h3>
                        <p style="margin: 0">
                            For {{ $appointment->user->name }} 
                            {{ $appointment->user->surname }},
                        </p>
                        <p>Visited on {{ \Carbon\Carbon::parse($appointment->date)->format('jS \o\f F Y') }}</p>
                    </div>

                    <form method="POST" action="{{ route('doctor.create.prescription') }}">
                        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                        @csrf

                        <div class="diagnosis-heading">
                            <h4>Diagnosis<h4>
                        </div>
                    
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="diagnosis"></textarea>
                        </div>
                        

                        <div class="treatment-heading"><h4>Treatment<h4></div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="treatment"></textarea>
                        </div>

                        <input class="btn btn-primary" type="submit" value="Publish">
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection