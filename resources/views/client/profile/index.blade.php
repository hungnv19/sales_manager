@extends('client.layouts.client')
@section('content')
    <section class="content">
        <user-profile
            :data="{{ json_encode([
                'user' => $user,
                'urlStore' => route('profile-update'),
            ]) }}">
        </user-profile>
    </section>
@endsection
