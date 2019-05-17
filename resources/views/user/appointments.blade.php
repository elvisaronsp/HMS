@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">


                    <div class="card-body">
                        <form method="POST" action="/user/appointments/check/date">
                            @csrf
                            <div class="form-group">
                                <label for="">Speciality</label>
                                <select class="form-control" name="specialty" id="speciality">
                                    @foreach ($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="">Date</label>
                            <input type="date" class="form-control" name="date" id="date">
                            
                            <input type="submit" class="btn btn-primary" value="Check">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection