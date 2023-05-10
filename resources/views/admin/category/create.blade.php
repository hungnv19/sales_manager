@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Category</a></li>
                        <li class="breadcrumb-item"><a href="">Create</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <category-create
            :data="{{ json_encode([
                
                'urlStore' => route('category.store'),
                'urlBack' => route('category.index'),
                
            ]) }}">
            </category-create>
    </section>
@endsection
