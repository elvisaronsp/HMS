@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card wrapper-card shadow-sm">

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.appointment.check.date') }}">
                            @csrf
                            <div class="form-group">
                                <label for="speciality">Speciality</label>
                                <select class="form-control" name="specialty" id="speciality">
                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="date">Date</label>
                            <input type="date" class="form-control datepicker" name="date" id="date">

                            <input type="submit" class="btn btn-primary appoint-check-btn" value="Check">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>


    </script>
@endsection