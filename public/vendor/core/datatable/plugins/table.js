
MetronicTable = function () {
    var callbackBulkAction     = null;

    function _handleTrashRestoreDel(action, grid) {

        if (['bulk_trash', 'bulk_restore', 'bulk_delete'].indexOf(action.val()) > -1) {
            if (action.find(':selected').data('event')) {
                var ajaxUrl = action.find(':selected').data('ajax-url'),
                    method = action.find(':selected').data('method');

                if( typeof method == 'undefined' ) {
                    method = 'post';
                }
                if (typeof action == 'object') {
                    filter = (action.val() == 'bulk_trash') ? '' : 1;
                } else if (typeof action == 'string') {
                    filter = (action == 'bulk_trash') ? '' : 1;
                }

                bulkActions(grid.getSelectedRows(), ajaxUrl, method, filter, action);
            }
        }
    }

    function _resetEventAjax(action, grid) {
        grid.setAjaxParam("customActionType", "group_action");
        grid.setAjaxParam("customActionName", action.val());
        grid.setAjaxParam("id", grid.getSelectedRows());
        grid.getDataTable().ajax.reload();
        grid.clearAjaxParams();
    }

    function bulkActions(ids, ajaxUrl, method, filter, action) {
        if( typeof method == 'undefined' ) {
            method = 'post';
        }
        filter = (filter == 'bulk_trash') ? '' : 1;

        if ( ids.length == 0 ) {
            return;
        }
        $.ajax({
            url: ajaxUrl,
            type: method,
            cache: false,
            data: {'ids' : ids},
            beforeSend: function () {
                $.blockUI(FOMO.blockMetronicUI);
            },
            success: function( response ) {
                $.unblockUI();
                $('.table-container .table-group-action-input').val('');
                if ( response.errors == false ) {
                    toastr.success(response.data.message);
                    if (typeof action === 'string') {
                        AjaxDatatable.filter(filter);
                    }
                    if (typeof action === 'object') {
                        let table = action.closest('ul').next('.table-container').find('table');
                        let tableID = null;
                        if (table.length === 1) {
                            tableID = table.context.id;
                        }else {
                            tableID = action.closest('.table-container').find('table').attr('id');
                        }
                        if (tableID) {
                            AjaxDatatable.resetTable($('#' + tableID));
                        }

                    }

                    /**
                     * callback function
                     */
                    if (typeof callbackBulkAction === 'function') {
                        callbackBulkAction();
                    }
                }
            },
            error: function(jqXHR, exception) {
                $.unblockUI();
                if ( jqXHR.status === 400 ) {
                    toastr.error(jqXHR.responseJSON.message);
                    AjaxDatatable.filter(filter);
                }
            }
        });
    }

    const fixResponsiveDatatable = function () {
        $(document).find("table.dataTable").each(function (index) {
            if ($(this).width() > ($(this).find('thead').width() + 5)) {
                $(this).css('display', 'table');
            }
        });
    }

    return {

        init: function init() {
            fixResponsiveDatatable();
            /**
             * Bulk actions support
             */
            AjaxDatatable.onGroupActionSubmit(function(action, grid) {
                var behaviour = action.val(),
                    selectedRows = grid.getSelectedRows();

                switch (behaviour) {
                    case 'bulk_trash':
                    case 'bulk_restore':
                    case 'bulk_delete':
                        _handleTrashRestoreDel(action, grid);
                        return;
                }

                _resetEventAjax(action, grid);
            });

        },
        handleTrashRestoreDel: function handleTrashRestoreDel(action, grid) {
            return _handleTrashRestoreDel(action, grid);
        },

        resetEventAjax: function resetEventAjax(action, grid) {
            return _resetEventAjax(action, grid);
        },
        onCallbackBulkAction: function(callback) {
            callbackBulkAction = callback;
        },
    };
}();

jQuery(document).ready(function() {

    AjaxDatatable.init();

    AjaxDatatable.onAjaxLoaded(function(oSettings) {
        $(document).find('table .datatable-select2').select2();
    });

    //init functions Table
    MetronicTable.init();
});