
@extends('client')
@section('content')
    <section class="content">
        <h1 style="text-align: center">Reset Password</h1>
        <reset-pass
            :data="{{ json_encode([
                'urlStore' => route('reset.password.post'),
            ]) }}">
        </reset-pass>
    </section>
@endsection
