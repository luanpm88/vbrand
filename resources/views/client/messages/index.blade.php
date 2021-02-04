@extends('client.layouts.message')

@section('title')
    vBRand Messages
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <code class="notification"></code>
        </div>
    </div>
    <script>
        Echo.private('Messenger')
        .listen('MessengerNotification', (e) => {
            $('.notification').html(e.message);
        });
    </script>
@endsection