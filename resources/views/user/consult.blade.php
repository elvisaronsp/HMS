@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
                
            @foreach ($doctors as $doctor)
                @if($loop->iteration % 4 == 0 )
                    <div class="row">
                @endif

                    <div class="col-3">
                        <div class="card shadow">
                            {{ $doctor->name }}
                        </div>
                    </div>

                @if($loop->iteration % 4 == 0 )
                {{-- TODO: --}}
                @endif
            @endforeach

            
        </div>
    </div>
@endsection

@section('js')

@endsection