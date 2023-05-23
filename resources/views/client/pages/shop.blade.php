@extends('client.layouts.client')
@section('content-title', 'Trang sản phẩm')
@section('content')
    <section class="shop spad">
        <section class="breadcrumb-option">
            <div class="container">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__text">
                            <h4>Shop</h4>
                            <div class="breadcrumb__links">
                                <a href="{{ asset('/') }}">Home</a>
                                <a href="{{ asset('/shop') }}">Shop</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{ route('searchProduct') }}">
                                @csrf
                                <input type="text" width="400px" name="name" placeholder="Tìm kiếm"
                                    class="form-control">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">

                                                @foreach ($categories as $category)
                                                    <li class="li_cte">
                                                        <a class="cte-links"
                                                            href="{{ route('categoryProducts', $category->id) }}">{{ $category->category_name }}</a>
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a href="#">$0.00 - $50.00</a></li>
                                                    <li><a href="#">$50.00 - $100.00</a></li>
                                                    <li><a href="#">$100.00 - $150.00</a></li>
                                                    <li><a href="#">$150.00 - $200.00</a></li>
                                                    <li><a href="#">$200.00 - $250.00</a></li>
                                                    <li><a href="#">250.00+</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                <label for="xs">Nhỏ
                                                    <input type="radio" id="xs">
                                                </label>
                                                <label for="sm">Vừa
                                                    <input type="radio" id="sm">
                                                </label>
                                                <label for="md">Lớn
                                                    <input type="radio" id="md">
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="col-6">
                                    <label for="" class="form-label">Sort by Price:</label>
                                </div>

                                <div class="col-6">
                                    <select class="form-control " aria-label="Default select example">
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                            @if ($product->product_quantity >= 1)
                                <div class="col-lg-4 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">

                                    <div class="product__item">

                                        <div class="product__item__pic set-bg"
                                            data-setbg="{{ Storage::url($product->image) }}">


                                            <ul class="product__hover">
                                                @if (Auth::user())
                                                    <li><a href="{{ route('add-wishlist', $product->id) }}"><img
                                                                src="img/icon/heart.png" alt=""></a></li>
                                                @endif
                                                <li><a href=" {{ route('productDetail', $product->id) }}"><img
                                                            src="img/icon/search.png" alt=""></a></li>
                                            </ul>
                                        </div>

                                        <div class="product__item__text">
                                            <h6> {{ $product->product_name }}</h6>
                                            <a href="{{ route('cart.addToCart', $product->id) }}" class="add-cart">+ Add To
                                                Cart</a>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>

                                            <h5> {{ number_format($product->selling_price) . ' Đ' }}</h5>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
