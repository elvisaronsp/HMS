@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <chat-app></chat-app>
            {{-- <div class="col-4">
                <div id="doctor-list-wrapper">

                    @foreach ($doctors as $doctor)
                    <div class="card contact-card shadow-sm" id="{{ $doctor->id }}">
                        <div class="row">
                            <div class="col-4">
                                <img  class="chat-avatar" src="{{ $doctor->image }}">
                            </div>

                            <div class="col-8">
                                <p class="contact-name">{{ $doctor->name }} {{ $doctor->surname }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div> --}}

            {{-- <div class="col-8">
                <chat-app></chat-app> --}}
                {{-- <chat-messages :messages="messages" :authUser="{{ Auth::user() }}"></chat-messages> --}}
                {{-- <div class="card typeing-box">
                    <form method="POST" action="/messages">
                        @csrf
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message_text"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary mb-2" style="margin-top:30%">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
                
            {{-- @foreach ($doctors as $doctor)
                @if($loop->iteration % 4 == 0 )
                    <div class="row">
                @endif

                    <div class="col-3">
                        <div class="card contact-card shadow">
                            {{ $doctor->name }}
                        </div>
                    </div>

                @if($loop->iteration % 4 == 0 ) --}}
                {{-- TODO: --}}
                {{-- @endif
            @endforeach --}}

            
        </div>
    </div>
@endsection

@section('js')
<script>
    new SimpleBar(document.getElementById('doctor-list-wrapper'));
    new SimpleBar(document.getElementById('chat-wrapper'));
</script>
@endsection