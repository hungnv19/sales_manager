@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Product</a></li>
                        <li class="breadcrumb-item"><a href="">Edit</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <product-edit
            :data="{{ json_encode([
                'urlUpdate' => route('product.update', $product->id),
                'urlBack' => route('product.index'),
                'urlCheckCode' => route('product.checkCode'),
                'categories' => $categories,
                'colors' => $colors,
                'sizes' => $sizes,
                'product' => $product,
            ]) }}">
        </product-edit>
    </section>
@endsection
