@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card register shadow-lg">
                <div class="card-body">
                    <p class="centered-title">Creating new account</p>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" style="margin: 60px">
                        @csrf

                        <!-- Name -->
                        <div class="form-group row">
                            
                            <input id="name" placeholder="Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <!-- Surname -->
                        <div class="form-group row">
                            <input id="surname" placeholder="Surname" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>

                            @if ($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <!-- Birthday -->
                        <div class="form-group row">

                           
                            <label>Choose birthday</label>
                            <input id="birthday" placeholder="Birthday" type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" value="{{ old('birthday') }}" required autofocus>

                            @if ($errors->has('birthday'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <!-- Gender -->
                        <div class="form-group row">
                                   
                            <select class="form-control" name="gender" id="gender" required autofocus>
                                <option>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>

                            @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <!-- Phone -->
                        <div class="form-group row">

                                     
                            <input id="phone" placeholder="Phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <!-- Address -->
                        <div class="form-group row">
                                    
                            <input id="address" placeholder="Address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>

                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                           
                        </div>

                        <!-- Blood type -->
                        <div class="form-group row">
                                   
                            <select class="form-control" name="bloodtype" id="bloodtype" required autofocus>
                                <option>Select Blood Type</option>
                                <option value="1">AB+</option>
                                <option value="2">AB-</option>
                                <option value="3">A+</option>
                                <option value="4">A-</option>
                                <option value="5">B+</option>
                                <option value="6">B-</option>
                                <option value="7">O+</option>
                                <option value="8">O-</option>
                            </select>

                            @if ($errors->has('bloodtype'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bloodtype') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                        
                        <!-- Avatar -->
                        <div class="form-group row">
                            
                            <p>Choose avatar</p>    
                            <input id="address" type="file"  placeholder="Avatar" class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}" name="avatar" value="{{ old('avatar') }}" required autofocus>

                            @if ($errors->has('avatar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <!-- Email -->
                        <div class="form-group row">
                            
                            <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <!-- Password -->
                        <div class="form-group row">
                            
                            <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group row">
                            
                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                            
                        </div>

                        
                           
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                            
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
