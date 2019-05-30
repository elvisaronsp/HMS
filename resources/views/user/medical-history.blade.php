@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @foreach ($medicalHistory as $record)
                    <div class="card shadow history-card">
                        <div class="card-body">
                            <div class="row history-wrapper">
                                <div class="col-4 history-date">
                                    <p>{{ Str::limit($record->time, 5, '') }}
                                    <p class="history-heading">{{ \Carbon\Carbon::parse($record->date)->format('jS \o\f F Y') }}</p>
                                    
                                </div>

                                <div class="col-4 history-time">
                                    <p>{{ $record->doctor->specialty->title }}</p>
                                    <p class="history-heading">
                                        {{ $record->doctor->name }} {{ $record->doctor->surname }}
                                    </p>
                                </div>

                                <div class="col-4 history-link">
                                    @if($record->prescription)                        
                                        <a href="/user/prescription/{{ $record->prescription->id }}">
                                            <button type="button" class="btn btn-primary">
                                                Prescription
                                            </button>
                                        </a>
                                    @else 
                                        <button type="button" class="btn btn-primary" disabled>
                                            Prescription
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row justify-content-center">
                    {{ $medicalHistory->links() }}
                </div>       
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection