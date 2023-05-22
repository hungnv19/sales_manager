@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Color Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Color</a></li>
                        <li class="breadcrumb-item"><a href="">Edit</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <color-edit
            :data="{{ json_encode([
                'color' => $color,
                'urlUpdate' => route('colors.update', $color->id),
                'urlBack' => route('colors.index'),
                
            ]) }}">
            </color-edit>
    </section>
@endsection
