$(document).ready(function () {
    "use strict";

    $(document).on('click', '#btn-search', function (e) {
        e.preventDefault();
        if(!validURL($('#url').val())){
            alert("Đường dẫn không đúng định dạng!");
            $('#url').focus();
            return;
        }
        showLoading();
        var url = './api/sharelink/557706784511';
        $.ajax({
            url: url,
            type: 'GET',
            loading: true,
            dataType: "html",
            data: {},
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
