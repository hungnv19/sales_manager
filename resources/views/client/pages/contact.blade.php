@extends('client.layouts.client')
@section('content')
    
    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae exercitationem non nisi
                                sit ab dolores numquam totam magni! Ducimus nemo in enim aperiam labore illum eveniet fugiat
                                doloribus blanditiis harum.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>Cơ sở 1</h4>
                                <p>15 - ngõ 80 Xuân Phương - Nam Từ Liêm - Hà Nội <br />+84 0962523872</p>
                            </li>
                            <li>
                                <h4>Cơ sở 2</h4>
                                <p>Xóm Đông - Nam Phú - Nam Phong - Phú Xuyên - Hà Nội<br />+84 0962523872</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <contact-form
                            :data="{{ json_encode([
                                'urlStore' => route('contact.us.store'),
                            ]) }}">
                        </contact-form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
