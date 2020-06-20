var init = function () {
    let myLink = false;
    const pid = 'mm_566430049_1414400150_110148550222';
    const searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('ali_trackid')) {
        const trackid = searchParams.get('ali_trackid').split(':');
        if (trackid.length > 2 && trackid[1] === pid) {
            myLink = true;
        }
    }

    if (myLink) {
        const html = '<div id="chietkhau_tool" style="position: fixed;bottom: 0;width: 100%;background-color: darkgreen;z-index: 9999999999;text-align: center;height: 30px;">' +
            '<p style="font-size: 12px; color: #FF8000; margin-top: 2px;">Hãy mua hàng để nhận chiết khấu!</p>' +
            '</div>';
        $("body").append(html);
    } else {
        const time = Date.now();
        const token = btoa(location.href + time.toString());

        $.ajax({
            method: "GET",
            url: "https://chietkhautaobao.com.vn/api/sharelink",
            data: {url: location.href, key: time, token: token}
        }).done(function (response, textStatus, jqXHR) {
            if (response.refund_value !== '') {
                const html = '<div id="chietkhau_tool" style="position: fixed;bottom: 0;width: 100%;background-color: darkgreen;z-index: 9999999999;text-align: center;height: 120px;">' +
                    '<p style="font-size: 18px; font-weight: bold; margin-top: 15px;"><span style="color: white;">Chiết khấu: </span><span style="color: white;">' + response.refund_value + '¥</span></p>' +
                    '<p style="font-size: 12px; color: #FF8000; margin-top: 2px;">Bạn phải đổi link trước khi mua hàng!</p>' +
                    '<a target="_blank" style="height: 50px; width: 120px; font-size: 14px; font-weight: bold; cursor: pointer;display: inline-block;\n' +
                    '    background-color: white;\n' +
                    '    line-height: 50px;\n' +
                    '    border-radius: 10px;" href="https://chietkhautaobao.com.vn/link?flatform=1&url=' + encodeURIComponent(location.href) + '">Click lấy link!</a>' +
                    '</div>';
                $("body").append(html);
            }else{
                const html = '<div id="chietkhau_tool" style="position: fixed;bottom: 0;width: 100%;background-color: darkgreen;z-index: 9999999999;text-align: center;height: 60px;">' +
                    '<p style="font-size: 18px; color: #FF8000; margin-top: 2px;">Rất tiếc, không có link chiết khấu cho sản phẩm này!</p>' +
                    '</div>';
                $("body").append(html);
            }
        });
    }
}
init();
