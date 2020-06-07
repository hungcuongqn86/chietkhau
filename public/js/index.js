$(document).ready(function () {
    "use strict";
    $('#url-warning').hide();

    $(document).on('click', '#btn-search', function (e) {
        e.preventDefault();
        $('#url-warning').hide();
        if($('#url').val() == ''){
            $('#url-warning').show().text('Phải nhập đường dẫn sản phẩm cần mua!');
            $('#url').focus();
            return;
        }

        if(!validURL($('#url').val())){
            $('#url-warning').show().text('Đường dẫn không đúng định dạng!');
            $('#url').focus();
            return;
        }
        showLoading();
        var url = './api/sharelink/';
        $.ajax({
            url: url,
            type: 'GET',
            loading: true,
            dataType: "html",
            data: {url: $('#url').val()},
            success: function (html) {
                $('#shareLinkModalBody').html(html);
                $('#shareLinkModal').modal({
                    backdrop: 'static',
                    keyboard: false
                }).show();
                hideLoading();
            }
        });
    });
});

function validURL(str) {
    const pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str);
}

function showLoading() {
    $('.loading').show();
}

function hideLoading() {
    $('.loading').hide();
}
