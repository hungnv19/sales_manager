@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Size Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Size</a></li>
                        <li class="breadcrumb-item"><a href="">Create</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <size-create
            :data="{{ json_encode([
                'urlStore' => route('sizes.store'),
                'urlBack' => route('sizes.index'),
            ]) }}">
        </size-create>
    </section>
@endsection
