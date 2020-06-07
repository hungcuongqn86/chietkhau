<div class="card chietkhau-card">
    <div class="card-body">
        @if(!empty($data))
        <div class="input-group mb-12">
            @guest
                <div class="alert alert-danger">
                    <h5>
                        <i class="icon fas fa-ban"></i> Cảnh báo
                    </h5>
                    Hệ thống không thể ghép đơn hàng! Vui lòng đăng nhập tài khoản trước khi mở link chiết khấu
                </div>
            @endguest

            <div class="phone-box chietkhau-box">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Mobile</span>
                    </div>
                    <input type="text" class="form-control alipay-link" value="￥xxxxxxxxxxx￥" readonly="">
                    <div class="input-group-append">
                        <button class="alipay-copy bg-info border-info white">copy</button>
                    </div>
                </div>
            </div>

            <div class="price-box chietkhau-box">
                <span class="price">Giá : {{$data->zk_final_price}}¥</span>
                <span class="text-red text-bold price float-right">Chiết khấu: {{((double)$data->zk_final_price - (double)$data->coupon_amount)*(double)$data->commission_rate/10000}}¥</span>
            </div>

            <div class="">
                <div class="product-img d-flex align-items-center">
                    <a href="/site/delaylink?web=1&amp;item_id=7675223939">
                        <img src="{{$data->pict_url}}" class="img-fluid mb-1">
                    </a>
                </div>
            </div>
            <a href="/site/delaylink?web=1&amp;item_id=7675223939">
                <h3>{{$data->title}}</h3>
            </a>
        </div>
        @else
            <div class="input-group mb-12">
                <div class="alert alert-danger alert-dismissible">
                    Không tìm thấy link sản phẩm thích hợp!
                </div>
            </div>
        @endif
    </div>
</div>
