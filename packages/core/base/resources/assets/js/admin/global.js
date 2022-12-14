BaseGlobal = function () {
    const _callAjax = function (url, method, params = {}, callbackSuccess = null, callbackError = null) {
        $.ajax({
            url: url,
            type: method,
            data: params,
            beforeSend: function beforeSend() {
                mApp.blockPage(InitGlobal.blockPage);
            },
            success: function success(response) {
                mApp.unblockPage();
                if (callbackSuccess) {
                    eval(callbackSuccess)(response);
                }
            },
            error: function error(jqXHR, exception) {
                if (callbackError) {
                    eval(callbackError)(jqXHR);
                }
            },
            complete: function (xhr,status) {
                mApp.unblockPage(InitGlobal.blockPage);
            }
        });
    };

    return {
        init: function () {
        },

        _callAjax: function (url, method, params = {}, callbackSuccess = null, callbackError = null) {
            _callAjax(url, method, params, callbackSuccess, callbackError);
        }
    };

}();

jQuery(document).ready(function() {
    BaseGlobal.init();
});


module.exports = BaseGlobal;
