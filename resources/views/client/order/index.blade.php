@extends('client.layouts.client')
@section('content')

    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Order List</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">Order </a>
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
                                    <form action="{{ route('order.index') }}" method="GET">
                                        <input name="search_input" class="form-control " placeholder="Search"
                                            autocomplete="off" id="search_input" value="{{ request('search_input') }}" type="control">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            @if ($orders->count() > 0)
                                <div class="table-responsive-sm">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Total Amount</th>
                                                <th>Pay</th>
                                                <th>Due</th>
                                                <th>Pay By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>
                                                        {{ $order->user_name }}

                                                    </td>
                                                    <td>
                                                        {{ number_format($order->total) . ' Đ' }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($order->pay) . ' Đ' }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($order->due) . ' Đ' }}
                                                    </td>
                                                    <td>
                                                        {{ $order->payBy }}
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary"
                                                            href="{{ route('order.show', $order->id) }}">Detail</a>
                                                        <form action="{{ route('order.destroy', $order->id) }}"
                                                            method="Post" style="display: inline-block; margin-left: 10px">
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

                                                <th>Name</th>
                                                <th>Total Amount</th>
                                                <th>Pay</th>
                                                <th>Due</th>
                                                <th>Pay By</th>
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
                    {{ $orders->links('pagination::bootstrap-5') }}
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
