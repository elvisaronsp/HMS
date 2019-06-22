@extends('layouts.doctor')

@section('content')
<div id="app">
    <div class="container">
        <chat-app :user="{{ auth()->user() }}"></chat-app>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function() {
        window.session = 'doctor'
        new SimpleBar(document.getElementById('doctor-list-wrapper'));
        // new SimpleBar(document.getElementById('chat-wrapper'));
    });
</script>
@endsection