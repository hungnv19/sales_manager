@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">User</a></li>
                        <li class="breadcrumb-item"><a href="">Create</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <user-create
            :data="{{ json_encode([
                'urlStore' => route('user.store'),
                'urlBack' => route('user.index'),
                'urlCheckEmail' => route('register.checkMail'),
            ]) }}">
        </user-create>
    </section>
@endsection
