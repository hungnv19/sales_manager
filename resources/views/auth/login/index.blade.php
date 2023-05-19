@extends('client')
@section('content')
    <section class="content">
        <h1 style="text-align: center">Login</h1>
        <login-form
            :data="{{ json_encode([
                'urlStore' => route('login.store'),
                'urlRegister' => route('register.create'),
                'urlForgotPassword' => route('forget.password.get'),
                'urlUserLogin' => route('login.checkUserLogin'),
            ]) }}">
        </login-form>
    </section>
@endsection
