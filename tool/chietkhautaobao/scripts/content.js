var init = function () {
    const time = Date.now();
    const token = btoa(location.href + time.toString());

    $.ajax({
        method: "GET",
        url: "https://chietkhautaobao.com.vn/api/sharelink",
        data: {url: location.href, key: time, token: token}
    }).done(function (response, textStatus, jqXHR) {
        console.log(response);
        // $('.unit-detail-order-action').append('<div  class="clearfix"></div><div id="doi_link" style="font-size: 24px ; margin: 15px 20px;color: ">' + result + '</div>');
        // $('.order-action-container').append('<div class="clearfix"></div><div id="doi_link" style="font-size: 24px ; margin: 15px 20px;color: ">' + result + '</div>');
    });
}
init();
