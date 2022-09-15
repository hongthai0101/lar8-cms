InitGlobal = {
    blockPage: {
        overlayColor: "#000000",
        type: "loader",
        state: "primary",
        message: "Processing..."
    },
};


(function($) {
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(xhr) {
                mApp.blockPage(InitGlobal.blockPage);
            },
            complete: function (xhr,status) {
                mApp.unblockPage(InitGlobal.blockPage);
            }
        });
        $(document).ajaxError(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {
            if (xhr.status === 500) {
                //return window.location.href = "/";
            }
        });
    });
}) (jQuery)
