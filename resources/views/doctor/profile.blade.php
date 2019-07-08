
@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="doctor-box">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $doctor->avatar }}" height="300px" width="300px">
                    <div class="endorse-btn-box">
                        @if($hasEndorsed)
                            <button class="btn btn-success endorse-disabled" disabled>Endorsed</button>
                        @else
                            <button class="btn btn-success endorse-btn">Endorse</button>
                        @endif
                    </div>
                </div>

                <div class="col-md-8">
                    <h3>Dr. {{ $doctor->name }} {{ $doctor->surname }}
                        <span id="endorse-box">
                            +<span id="rating">{{ $endorsement }}</span> Endorsement
                        </span>
                    </h3>
                    <p>{{ $doctor->specialty->title }}</p>
                    <h5>Connect</h5>
                    <p>{{ $doctor->phone }}</p>
                    <p>{{ $doctor->email }}</p>
                    <h5>Profile</h5>
                    {!! $doctor->about !!}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    var user_id = {!! $userId !!} ;
    $(function() {
        $(".endorse-btn").click(function(event){
            event.preventDefault();

            $.ajax({
                type: "POST",
                url: '/endorse',
                data: {
                    doctor_id: {!! $doctor->id !!},
                    user_id: {!! $userId !!},
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    let currentRating = parseInt($('#rating').html());
                    currentRating += 1
                    $('#rating').text(currentRating);
                    $('.endorse-btn-box').html('<button class="btn btn-success endorse-disabled" disabled>Endorsed</button>')
                },
                error() {
                    alert('You have already endorsed')
                }
            });
        });
    });
</script>
@endsection
