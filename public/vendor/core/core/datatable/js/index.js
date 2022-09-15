/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./packages/core/datatable/public/plugins/table.js":
/*!*********************************************************!*\
  !*** ./packages/core/datatable/public/plugins/table.js ***!
  \*********************************************************/
/***/ (() => {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

MetronicTable = function () {
  var callbackBulkAction = null;

  function _handleTrashRestoreDel(action, grid) {
    if (['bulk_trash', 'bulk_restore', 'bulk_delete'].indexOf(action.val()) > -1) {
      if (action.find(':selected').data('event')) {
        var ajaxUrl = action.find(':selected').data('ajax-url'),
            method = action.find(':selected').data('method');

        if (typeof method == 'undefined') {
          method = 'post';
        }

        if (_typeof(action) == 'object') {
          filter = action.val() == 'bulk_trash' ? '' : 1;
        } else if (typeof action == 'string') {
          filter = action == 'bulk_trash' ? '' : 1;
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
    if (typeof method == 'undefined') {
      method = 'post';
    }

    filter = filter == 'bulk_trash' ? '' : 1;

    if (ids.length == 0) {
      return;
    }

    $.ajax({
      url: ajaxUrl,
      type: method,
      cache: false,
      data: {
        'ids': ids
      },
      beforeSend: function beforeSend() {
        $.blockUI(FOMO.blockMetronicUI);
      },
      success: function success(response) {
        $.unblockUI();
        $('.table-container .table-group-action-input').val('');

        if (response.errors == false) {
          toastr.success(response.data.message);

          if (typeof action === 'string') {
            AjaxDatatable.filter(filter);
          }

          if (_typeof(action) === 'object') {
            var table = action.closest('ul').next('.table-container').find('table');
            var tableID = null;

            if (table.length === 1) {
              tableID = table.context.id;
            } else {
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
      error: function error(jqXHR, exception) {
        $.unblockUI();

        if (jqXHR.status === 400) {
          toastr.error(jqXHR.responseJSON.message);
          AjaxDatatable.filter(filter);
        }
      }
    });
  }

  var fixResponsiveDatatable = function fixResponsiveDatatable() {
    $(document).find("table.dataTable").each(function (index) {
      if ($(this).width() > $(this).find('thead').width() + 5) {
        $(this).css('display', 'table');
      }
    });
  };

  return {
    init: function init() {
      fixResponsiveDatatable();
      /**
       * Bulk actions support
       */

      AjaxDatatable.onGroupActionSubmit(function (action, grid) {
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
    onCallbackBulkAction: function onCallbackBulkAction(callback) {
      callbackBulkAction = callback;
    }
  };
}();

jQuery(document).ready(function () {
  AjaxDatatable.init();
  AjaxDatatable.onAjaxLoaded(function (oSettings) {
    $(document).find('table .datatable-select2').select2();
  }); //init functions Table

  MetronicTable.init();
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!*********************************************************!*\
  !*** ./packages/core/datatable/public/plugins/index.js ***!
  \*********************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _table__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./table */ "./packages/core/datatable/public/plugins/table.js");
/* harmony import */ var _table__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_table__WEBPACK_IMPORTED_MODULE_0__);

})();

/******/ })()
;