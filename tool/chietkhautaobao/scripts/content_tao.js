var rootIdSelector = '';

function suggtb() {
    $(document).on('click', rootIdSelector + '.op-suggtb', function() {

        var check =  $('#hid').text();
        if (check.length == 1){
            $('.border').css('display','block');
            $('#hid').text('11');
        } else {
            $('.border').css('display','none');
            $('#hid').text('1');
        }
    });

    $(document).on('click', rootIdSelector + '.btcl', function() {
        var check =  $('#hid').text();
        if (check.length == 1){
            $('.border').css('display','block');
            $('#hid').text('11');
        } else {
            $('.border').css('display','none');
            $('#hid').text('1');
        }
    });

}
suggtb()
