@extends('layout.client')
@section('content')
    <section class="content">
        <h1 style="text-align: center">Register</h1>
        <register-form
            :data="{{ json_encode([
                'urlStore' => route('register.store'),
                'urlBack' => route('login.create'),
                'urlCheckEmail' => route('register.checkMail'),
            ]) }}">
        </register-form>
    </section>
@endsection
