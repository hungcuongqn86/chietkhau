function tite() {
    var tite = $('.d-title').text();

    var dome = 'https://chietkhau1688.vn/user-link/testurl?tite='+tite
    return dome
}


function tite1() {
    var tite = $('.d-title').text();

}

tite1()


var requestHandlers = {
    global_set_store: function (data, callback, sender) {
        store.set(data.key, data.value);
    },
    global_get_store: function (data, callback, sender) {
        callback(store.get(data.key));
    },
    loginfo: function (data, callback, sender) {
        console.log('thong tin', sender.tab.url, data.text);
    },
    closeme: function (data, callback, sender) {
        chrome.tabs.remove(sender.tab.id);
    },

    link: function (data, callback, sender) {
        return $.ajax({
            url: 'https://chietkhau1688.vn/user-link/geturl?url='+ data.url
        }).then(function (result) {
            callback(result);
        });
    },


	taobao: function (data, callback, sender) {
		return $.ajax({
			url: 'https://chietkhau1688.vn/user-link/geturltaobao?url='+ data.url
		}).then(function (result) {
			callback(result);
		});
    },

    sugg1688: function (data, callback, sender) {
        return $.ajax({
            url: 'https://chietkhau1688.vn/user-link/sugg1688?name='+ data.tite
        }).then(function (result) {
            callback(result);
        });
    },

    suggtb: function (data, callback, sender) {
        return $.ajax({
            url: 'http://www.robotchietkhau.com/suggtb.php?keyword='+ data.keyword
        }).then(function (result) {
            callback(result);
        });
    },
}




chrome.extension.onRequest.addListener(function (request, sender, sendResponse) {
    requestHandlers[request.handler](request, sendResponse, sender);
});

