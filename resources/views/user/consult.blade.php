@extends('layouts.user')

@section('content')
    <div class="container">
        <div id="app">

        <chat-app :user="{{ auth()->user() }}"></chat-app>
           

            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(function() {
        window.session = 'user'
        new SimpleBar(document.getElementById('doctor-list-wrapper'));
        // new SimpleBar(document.getElementById('chat-wrapper'));
    });
</script>
@endsection
