@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Link chiết khấu</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <h4>Nhấn vào sản phẩm kế bên để đến link chiết khấu!</h4>
                                <p>Bạn phải chắc chắn đã đăng nhập tài khoản tại http://chietkhautaobao.com.vn trước khi nhấn link chiết khấu!</p>
                                <p>Sau khi bạn mua hàng thành công, có thể kiểm tra đơn hàng trong mục "Đơn hàng"</p>
                                <p>Có thể mất đến vài phút để dữ liệu đồng bộ đơn hàng của bạn</p>
                                <p>Nếu không thấy đơn hàng hoặc có bất kỳ thắc mắc hãy liên hệ với chúng tôi</p>
                                <p>SĐT: 09777807</p>
                                <p>Zalo: 09777807</p>
                                <p>Chân thành cảm ơn!</p>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                @include('share_link')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
