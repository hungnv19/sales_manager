@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Size Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Size</a></li>
                        <li class="breadcrumb-item"><a href="">Edit</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <size-edit
            :data="{{ json_encode([
                'size' => $size,
                'urlUpdate' => route('sizes.update', $size->id),
                'urlBack' => route('sizes.index'),
            ]) }}">
        </size-edit>
    </section>
@endsection
