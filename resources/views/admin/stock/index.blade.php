@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stock List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Stock</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Stock</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($products->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Root</th>
                                                <th>Category</th>
                                                <th>Buying Price</th>
                                                <th>Status</th>
                                                <th>Product Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>
                                                        {{ $product->product_name }}

                                                    </td>
                                                    <td>
                                                        {{ $product->product_code }}

                                                    </td>
                                                    <td>
                                                        {{ $product->root }}

                                                    </td>
                                                    <td>
                                                        {{ $product->categories_name }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($product->buying_price) . ' Đ' }}
                                                    </td>
                                                    @if ($product->product_quantity >= 1)
                                                        <td class="text-success">
                                                            Available
                                                        </td>
                                                    @else
                                                        <td class="text-danger">
                                                            Stock Out
                                                        </td>
                                                    @endif

                                                    <td>
                                                        {{ $product->product_quantity }}

                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('stock.edit', $product->id) }}">Edit</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="table-responsive-sm">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Product Code</th>
                                                <th>Root</th>
                                                <th>Category</th>
                                                <th>Buying Price</th>
                                                <th>Status</th>
                                                <th>Product Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <data-empty></data-empty>
                            @endif

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
