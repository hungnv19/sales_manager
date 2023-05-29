@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">User</a></li>
                        <li class="breadcrumb-item"><a href="">Edit</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <user-edit
            :data="{{ json_encode([
                'urlUpdate' => route('user.update', $user->id),
                'urlBack' => route('user.index'),
                'urlCheckEmail' => route('register.checkMail'),
                'user' => $user,
            ]) }}">
        </user-edit>
    </section>
@endsection
