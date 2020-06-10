var init = function () {

    chrome.extension.sendRequest({handler: 'link', url: location.href}, function (result) {
        $('.unit-detail-order-action').append('<div  class="clearfix"></div><div id="doi_link" style="font-size: 24px ; margin: 15px 20px;color: ">'+result+'</div>');
		$('.order-action-container').append('<div class="clearfix"></div><div id="doi_link" style="font-size: 24px ; margin: 15px 20px;color: ">'+result+'</div>');
    });
	
	chrome.extension.sendRequest({handler: 'taobao', url: location.href}, function (result) {
     //   $('.tb-extra').append('<div  class="tb-extra"></div><div id="doi_link" style="font-size: 24px ; margin: 15px 20px;color: ">'+result+'</div>');
	//	$('.tm-ser').append('<div class="tm-ser"></div><div id="doi_link" style="font-size: 20px ; margin: 15px 20px;color: ">'+result+'</div>');
		$('.tb-key').append('<div class=""></div><div id="doi_link" style="font-size: 20px ; margin: 10px 15px;color: ">'+result+'</div>');
    });


    chrome.extension.sendRequest({handler: 'dingdan1688', url: location.href}, function (result) {
      //   $('.nav-arrow').append('<div  class="tb-extra"></div><div id="doi_link" style="z-index: 9999 ">'+result+'</div>');
       $('.csbc-wk-switch-0-1-5').append('<div  class="tb-extra"></div><div id="doi_link" style=" position:absolute ; z-index: 999999999">'+result+'</div>');
    //    $('.main').append('<div  class="tb-extra"></div><div  >'+result+'</div>');
    });

    var tite = $('h1').text()

  //  console.log(tite)

    console.log(window.location.host)

    var url = window.location.host
    taobao =  url.indexOf('taobao.com')
  //  console.log(taobao)

    if (taobao > 1){
        titetb = $('#J_Title').text()
        titetb = titetb.trim()
        console.log(titetb)
        keyword = titetb
    }

    tmall =  url.indexOf('tmall.com')
    if (tmall > 1){
        titeTmall = $('h1').text()

        titeTmall = titeTmall.slice(20)
        titeTmall = titeTmall.trim()
        keyword = titeTmall


    }

    chrome.extension.sendRequest({handler: 'sugg1688' , tite: tite }, function (result) {

        $('.unit-detail-order-action').append('<div  class="clearfix"></div><div id="sugg1688"  >'+result+'</div>');
        $('.order-action-container').append('<div class="clearfix"></div><div id="sugg1688" >'+result+'</div>');
    });

    chrome.extension.sendRequest({handler: 'suggtb' , keyword: keyword }, function (result) {

        $('.tb-key').append('<div class=""></div><div id="suggtb" style="font-size: 20px ; margin: 10px 15px;color: ">'+result+'</div>');
    });
}



init();

