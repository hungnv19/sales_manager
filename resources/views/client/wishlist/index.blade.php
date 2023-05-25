@extends('client.layouts.client')
@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>WishList</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">WishList</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <div class="row" style="">

                                <div class="col-12">
                                    <form action="{{ route('wishlist.index') }}" method="GET">
                                        <input name="search_input" class="form-control " placeholder="Search"
                                            autocomplete="off" id="search_input" value="" type="control">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">

                        <div class="card-body">
                            @if ($wishlists->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Root</th>
                                                <th>Selling Price</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wishlists as $wishlist)
                                                <tr>

                                                    <td>
                                                        <img src=" {{ Storage::url($wishlist->product->image) }}"
                                                            style="width: 140px; height: 140px; object-fit: cover" />

                                                    </td>
                                                    <td>
                                                        {{ $wishlist->product->product_name }}

                                                    </td>
                                                    <td>
                                                        {{ $wishlist->product->product_code }}

                                                    </td>
                                                    <td>
                                                        {{ $wishlist->product->root }}

                                                    </td>
                                                    <td>
                                                        {{ number_format($wishlist->product->selling_price) . ' Đ' }}
                                                    </td>

                                                    <td>

                                                        <form action="{{ route('wishlist.destroy', $wishlist->id) }}"
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
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Root</th>
                                                <th>Selling Price</th>
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
                    {{ $wishlists->links('pagination::bootstrap-5') }}
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <br>
@endsection
