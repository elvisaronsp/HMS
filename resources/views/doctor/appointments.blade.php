@extends('layouts.doctor')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 style="text-align:center">Today's Appointments</h3>

                @if (count($appointmentForToday) > 0)
                @foreach ($appointmentForToday as $record)
                    <div class="card shadow history-card">
                        <div class="card-body">
                            <div class="row history-wrapper">
                                <div class="col-4 history-date">
                                    <p>{{ Str::limit($record->time, 5, '') }}
                                    <p class="history-heading">{{ \Carbon\Carbon::parse($record->date)->format('jS \o\f F Y') }}</p>
                                    
                                </div>

                                <div class="col-4 history-time">
                                    <p>Patient</p>
                                    <p class="history-heading">
                                        {{ $record->user->name }} {{ $record->user->surname }}
                                    </p>
                                </div>

                                <div class="col-4 history-link">
                                    @if($record->prescription)                        
                                        <a href="/doctor/prescription/{{ $record->prescription->id }}">
                                            <button type="button" class="btn btn-success">
                                                View Prescription
                                            </button>
                                        </a>
                                    @else 
                                        <a href="/doctor/prescription/new/{{ $record->id }}">
                                            <button type="button" class="btn btn-primary">
                                                Write Prescription
                                            </button>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else 

                @endif

                <div class="row justify-content-center">
                    {{-- {{ $medicalHistory->links() }} --}}
                </div>       
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection