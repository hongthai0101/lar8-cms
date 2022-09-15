var BaseDatatable = function () {

    const dataTableDestroyItem = '.dataTable-destroy-item';
    const dataTableBtnReload ='.buttons-reload';
    const dataTableConfirmDestroyModal = '.modal-datatable-confirm-destroy';
    const dataTableConfirmDestroyBtn = '.btn-datatable-confirm-destroy';

    const actionDestroy = function () {
        $(document).on("click", dataTableDestroyItem, function() {
            const url = $(this).data('url');
            const wrapperId = $(this).data('wrapper-id');
            $(dataTableConfirmDestroyBtn).attr('data-url', url).attr('data-wrapper-id', wrapperId);
            $(dataTableConfirmDestroyModal).modal('show');
        });
    };

    const confirmDestroy = function (url) {
        $(document).on("click", dataTableConfirmDestroyBtn, function() {
            const url = $(this).attr('data-url');
            const wrapperId = $(this).attr('data-wrapper-id');
            BaseGlobal._callAjax(
                url,
                'DELETE',
                {},
                actionDestroySuccess,
                actionDestroyFailure
            );

            $('#' + wrapperId).find(dataTableBtnReload).trigger('click');
            $(dataTableConfirmDestroyModal).modal('hide');
        });
    };

    const actionDestroySuccess = function (response) {
        if (response.status) {
            toastr.success("Destroy item successfully!");
        }
    };

    const actionDestroyFailure = function (exception) {
        toastr.error("Destroy item failure!");
    };

    return {
        init: function init() {
            actionDestroy();
            confirmDestroy();
        }
    }
}();

$(document).ready(function() {
    BaseDatatable.init();
});