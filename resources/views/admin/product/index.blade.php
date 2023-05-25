@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Product</a></li>

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
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <div class="row" style="">
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                <div class="col-9">
                                    <form action="{{ route('product.index') }}" method="GET">
                                        <input name="search_input" class="form-control " placeholder="Search"
                                            autocomplete="off" id="search_input" value="{{ request('search_input') }}" type="control">
                                    </form>
                                </div>
                                &nbsp;
                                <div class="col-2">
                                    <a class="btn btn-sm btn-primary" href="{{ route('product.create') }}"
                                        style="float: right; height: 38px; padding-top: 5px; ">Create</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">

                        <div class="card-body">
                            @if ($products->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Root</th>
                                                <th>Buying Price</th>
                                                <th>Selling Price</th>
                                                <th>Buying Date</th>
                                                <th>Image</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>

                                                    <td>
                                                        {{ $product->id }}

                                                    </td>
                                                    <td>
                                                        {{ $product->categories_name }}

                                                    </td>
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
                                                        {{ number_format($product->buying_price) . ' Đ' }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($product->selling_price) . ' Đ' }}
                                                    </td>
                                                    <td>
                                                        {{ $product->buying_date }}

                                                    </td>
                                                    <td>
                                                        <img src=" {{ Storage::url($product->image) }}"
                                                            style="width: 60px; height: 60px; object-fit: cover" />
                                                    </td>
                                                    <td>
                                                        {{ $product->product_quantity }}

                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('product.edit', $product->id) }}">Edit</a>
                                                        <form action="{{ route('product.destroy', $product->id) }}"
                                                            method="Post" style="display: flex; margin-left: 10px">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="table-responsive-sm">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Root</th>
                                                <th>Buying Price</th>
                                                <th>Selling Price</th>
                                                <th>Buying Date</th>
                                                <th>Image</th>
                                                <th>Quantity</th>
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
                    {{ $products->links('pagination::bootstrap-5') }}
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
