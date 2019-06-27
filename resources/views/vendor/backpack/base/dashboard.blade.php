@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row" style="text-align: center">
                <div class="col-md-4">
                    <div class="user-box panel">
                        <h2>Patients<h2>
                        <i class="fa fa-users" style="font-size: 2em"></i>
                        <h1>{{ $users }}</h1>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="user-box panel">
                        <h2>Doctors<h2>
                        <i class="fa fa-user-md" style="font-size: 2em"></i>
                        <h1>{{ $doctors }}</h1>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="user-box panel">
                        <h2>Appointments<h2>
                        <i class="fa fa-calendar-check-o" style="font-size: 2em"></i>
                        <h1>{{ $appointments}} </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
