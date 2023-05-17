@extends('client.layouts.client')
@section('content-title', 'Trang sản phẩm')
@section('content')
    <!-- Header Section End -->
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ asset('/') }}">Home</a>

                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset($product->image) }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset($product->image) }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset($product->image) }}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="{{ asset($product->image) }}">
                                        <i class="fa fa-play"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset($product->image) }}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset($product->image) }}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset($product->image) }}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-4" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset($product->image) }}" alt="">
                                    <a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&list=RD8PJ3_p7VqHw&start_radio=1"
                                        class="video-popup"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset($product->image) }}" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--size-->
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h3>{{ $product->product_name }}</h3>
                            <h2 style=" color:red">{{ number_format($product->selling_price) . ' Đ' }}</h2>

                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                                <a href=" {{ route('cart.addToCart', $product->id) }}" class="primary-btn">add to cart</a>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="{{ asset('img/shop-details/details-payment.png') }} " alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <!--Content-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                        information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Loại : <span class="text-success">
                                                    {{ $product->category->category_name }}
                                                </span></h5>
                                            <p>
                                                @if ($product->product_quantity >= 1)
                                                    <p class="note">Trạng thái : <span class="text-success">
                                                            Còn hàng
                                                        </span></p>
                                                @else
                                                    <p class="note">Trạng thái : <span class="text-danger">
                                                            Hết hàng
                                                        </span></p>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5> Mô tả : </h5>
                                            <p class="note">{{ $product->describe }}</p>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <section style="background-color: #eee;">
                                            <div class="container my-5 py-5">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-md-12 col-lg-10 col-xl-8">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h3>Comments</h3>
                                                                <hr>
                                                                @if ($comments->count() > 0)
                                                                    @foreach ($comments as $comment)
                                                                        <div class="d-flex flex-start align-items-center">
                                                                            <div class="col-2">
                                                                                <img class="rounded-circle shadow-1-strong me-3"
                                                                                    src="https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg"
                                                                                    alt="avatar" width="60"
                                                                                    height="60" />
                                                                            </div>

                                                                            <div class="col-4">
                                                                                <h6 class="fw-bold text-primary mb-1">
                                                                                    {{ $comment->user->name }}</h6>
                                                                                <p class="text-muted small mb-0">
                                                                                    {{ $comment->created_at }}
                                                                                </p>
                                                                            </div>
                                                                        </div>

                                                                        <p class="mt-3 mb-4 pb-2"
                                                                            style="text-align: justify">
                                                                            {{ $comment->content }}
                                                                        </p>

                                                                        <hr>
                                                                    @endforeach
                                                                @else
                                                                    <br>
                                                                    <data-empty></data-empty>
                                                                @endif
                                                            </div>

                                                            <div class="card-footer py-3 border-0"
                                                                style="background-color: #f8f9fa;">
                                                                @if (Auth::user())
                                                                    <form
                                                                        action="{{ route('post-comment', $product->id) }}"
                                                                        method="post" novalidate="novalidate">
                                                                        @csrf

                                                                        <div class="d-flex flex-start w-100">

                                                                            <div class="form-outline w-100">
                                                                                <label class="form-label"
                                                                                    for="textAreaExample">Comment
                                                                                    Panel</label>
                                                                                <textarea class="form-control" name="content" id="textAreaExample" rows="4" style="background: #fff;"
                                                                                    rows="4" placeholder="Your Message"></textarea>

                                                                            </div>
                                                                        </div>
                                                                        <div class="float-end mt-2 pt-1">
                                                                            <button type="submit"
                                                                                class="btn btn-primary btn-sm">Post
                                                                                comment</button>
                                                                        </div>
                                                                    </form>
                                                                @else
                                                                    <h3>Bạn cần đăng nhập để thực hiện chức năng này!</h3>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla
                                            deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>
                </div>
            </div>
    </section>
    <!-- Shop Details Section End -->

@endsection
