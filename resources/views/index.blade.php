@extends('layouts.app')

@section('content')
    <!-- Masthead -->
    <header class="masthead text-white text-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1 class="mb-5">Nhập link sản phẩm <span style="color: #FF5000;">taobao</span>, <span style="color: #FF5000;">tmall</span>, <span style="color: #FF5000;">1688</span> để nhận link chiết khấu!</h1>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <form>
                        <div class="form-row">
                            <div class="col-12 col-md-9 mb-2 mb-md-0">
                                <input type="text" class="form-control form-control-lg" id="url" name="url" placeholder="Nhập link sản phẩm cần mua...">
                            </div>
                            <div class="col-12 col-md-3">
                                <button id="btn-search" type="submit" class="btn btn-block btn-lg btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon">
                            <!--<i class="icon-screen-desktop m-auto text-primary"></i>-->
							<img src="{{ asset('img/taobao/taobao_512.png') }}" class="img-fluid img-thumbnail img-100">
                        </div>
                        <h3>Taobao</h3>
                        <p class="lead mb-0"><a href="https://world.taobao.com/">taobao.com</a></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon">
                            <!--<i class="icon-layers m-auto text-primary"></i>-->
							<img src="{{ asset('img/tmall/tmall_512.png') }}" class="img-fluid img-thumbnail img-100">
                        </div>
                        <h3>Tmall</h3>
                        <p class="lead mb-0"><a href="https://www.tmall.com/">tmall.com</a></p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                        <div class="features-icons-icon">
                            <!--<i class="icon-check m-auto text-primary"></i>-->
							<img src="{{ asset('img/1688/1688_512.png') }}" class="img-fluid img-thumbnail img-100">
                        </div>
                        <h3>1688</h3>
                        <p class="lead mb-0"><a href="https://www.1688.com/">1688.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Showcases -->
    <section class="showcase testimonials">
        <div class="container">
            <div class="row no-gutters">

                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('img/chiet_khau_cao.jpg') }}');"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Chiết khấu cao</h2>
                    <p class="lead mb-0">When you use a theme created by Start Bootstrap, you know that the theme will look great on any device, whether it's a phone, tablet, or desktop the page will behave responsively!</p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{ asset('img/de_dang_sd.jpg') }}');"></div>
                <div class="col-lg-6 my-auto showcase-text">
                    <h2>Dễ dàng sử dụng</h2>
                    <p class="lead mb-0">Newly improved, and full of great utility classes, Bootstrap 4 is leading the way in mobile responsive web development! All of the themes on Start Bootstrap are now using Bootstrap 4!</p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('img/rut_tien.jpg') }}');"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Tiền rút về tài khoản nhanh - an toàn</h2>
                    <p class="lead mb-0">Landing Page is just HTML and CSS with a splash of SCSS for users who demand some deeper customization options. Out of the box, just add your content and images, and your new landing page will be ready to go!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="call-to-action text-white text-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h2 class="mb-4">Đăng ký tài khoản để nhận chiết khấu khi mua hàng! <br><span style="color: #FF5000;">Đăng ký ngay!</span></h2>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <div class="form-row">
                        <div class="col-12 col-md-3" style="margin: auto;">
                            <button type="submit" class="btn btn-block btn-lg btn-primary">Đăng ký!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- share link -->
    <div class="modal fade" id="shareLinkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Link chiết khấu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="shareLinkModalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="button" class="btn btn-primary">Đi tới sản phẩm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
