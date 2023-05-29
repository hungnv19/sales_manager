@extends('admin.layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item"><a href="">Orders</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
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
                                    <form action="{{ route('orders.index') }}" method="GET">
                                        <input name="search_input" class="form-control " placeholder="Search"
                                            autocomplete="off" id="search_input" value="{{ request('search_input') }}"
                                            type="control">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            @if ($orders->count() > 0)
                                <div class="table-responsive-sm table-bordered">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Pay</th>
                                                <th class="text-center">Due</th>
                                                <th class="text-center">Pay By</th>
                                                <th class="text-center th-120">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $order->user_name }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ number_format($order->total) . ' Đ' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ number_format($order->pay) . ' Đ' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ number_format($order->due) . ' Đ' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $order->payBy }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-primary" style=" display: inline-block "
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
                                <div class="table-responsive-sm table-bordered">
                                    <table class="table  align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Pay</th>
                                                <th class="text-center">Due</th>
                                                <th class="text-center">Pay By</th>
                                                <th class="text-center th-120">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <data-empty></data-empty>
                            @endif
                        </div>
                    </div>
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
