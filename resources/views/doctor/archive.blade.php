@extends('layouts.doctor')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if (count($archived) > 0)
                @foreach ($archived as $record)
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
                                        <button type="button" class="btn btn-primary" disabled>
                                            Write Prescription
                                        </button>          
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else 
                <div class=" empty-history justify-content-center">
                    <img src="/images/searching.png" class="empty-searching" height="500px" width="670px">
                    <p class="empty-text">No achived records yet</p>
                </div> 
                @endif

                <div class="row justify-content-center">
                    {{ $archived->links() }}
                </div>       
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection