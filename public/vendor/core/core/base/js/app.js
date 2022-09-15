/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./packages/core/base/resources/assets/js/admin/datatable.js":
/*!*******************************************************************!*\
  !*** ./packages/core/base/resources/assets/js/admin/datatable.js ***!
  \*******************************************************************/
/***/ (() => {

var BaseDatatable = function () {
  var dataTableDestroyItem = '.dataTable-destroy-item';
  var dataTableBtnReload = '.buttons-reload';

  var actionDestroy = function actionDestroy() {
    $(document).on("click", dataTableDestroyItem, function () {
      alert("click bound to document listening for #test-element");
    });
  }; //
  // function ChangeType(){
  //     $(notificationType).on('change', function(){
  //         var val = $(this).val();
  //         let url = '';
  //         if (val == 1) {
  //             url = urlBlog;
  //         }
  //         if (val == 2) {
  //             url = urlChallenge;
  //         }
  //         if (val == 4){
  //             url = urlGift;
  //         }
  //
  //         if (url != '') {
  //             $(containerNotificationModel).removeClass('m--hide');
  //             $.ajax({
  //                 url: url,
  //                 type: 'GET',
  //                 data: {},
  //                 dataType: 'json',
  //                 success: function(data){
  //                     $.unblockUI();
  //                     $(notificationModel).select2({
  //                         data: data
  //                     })
  //                 },
  //                 error: function(data){
  //                     $.unblockUI();
  //                 },
  //                 beforeSend: function(){
  //                     $(notificationModel).empty().trigger("change");
  //                     $.blockUI(FOMO.blockMetronicUI);
  //                 }
  //             });
  //         }else {
  //             $(notificationModel).empty().trigger("change");
  //             $(containerNotificationModel).addClass('m--hide');
  //         }
  //     });
  // }


  return {
    init: function init() {
      actionDestroy();
    }
  };
}();

$(document).ready(function () {
  BaseDatatable.init();
});

/***/ }),

/***/ "./packages/core/base/resources/assets/js/admin/global.js":
/*!****************************************************************!*\
  !*** ./packages/core/base/resources/assets/js/admin/global.js ***!
  \****************************************************************/
/***/ ((module) => {

BaseGlobal = function () {
  var InitGlobal = {
    blockPage: {
      overlayColor: '#000000',
      type: 'v2',
      state: 'primary',
      message: 'Processing...'
    }
  };

  var _callAjax2 = function _callAjax(url, method) {
    var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
    var callbackSuccess = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
    var callbackError = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;
    $.ajax({
      url: url,
      type: method,
      data: params,
      beforeSend: function beforeSend() {
        KTApp.blockPage(InitGlobal.blockPage);
      },
      success: function success(response) {
        KTApp.unblockPage();

        if (callbackSuccess) {
          eval(callbackSuccess)(response);
        }
      },
      error: function error(jqXHR, exception) {
        KTApp.unblockPage();

        if (callbackError) {
          eval(callbackError)(jqXHR);
        }
      }
    });
  };

  return {
    init: function init() {},
    _callAjax: function _callAjax(url, method) {
      var params = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
      var callbackSuccess = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
      var callbackError = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;

      _callAjax2(url, method, params, callbackSuccess, callbackError);
    }
  };
}();

jQuery(document).ready(function () {
  BaseGlobal.init();
});
module.exports = BaseGlobal;

/***/ }),

/***/ "./packages/core/base/resources/assets/js/admin/index.js":
/*!***************************************************************!*\
  !*** ./packages/core/base/resources/assets/js/admin/index.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _global__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./global */ "./packages/core/base/resources/assets/js/admin/global.js");
/* harmony import */ var _global__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_global__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _datatable__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./datatable */ "./packages/core/base/resources/assets/js/admin/datatable.js");
/* harmony import */ var _datatable__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_datatable__WEBPACK_IMPORTED_MODULE_1__);



/***/ }),

/***/ "./packages/core/base/resources/assets/js/app.js":
/*!*******************************************************!*\
  !*** ./packages/core/base/resources/assets/js/app.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _admin__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./admin */ "./packages/core/base/resources/assets/js/admin/index.js");


/***/ }),

/***/ "./packages/core/datatable/resources/assets/sass/table.scss":
/*!******************************************************************!*\
  !*** ./packages/core/datatable/resources/assets/sass/table.scss ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


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
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
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
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/vendor/core/core/base/js/app": 0,
/******/ 			"vendor/core/core/datatable/css/table": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) var result = runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["vendor/core/core/datatable/css/table"], () => (__webpack_require__("./packages/core/base/resources/assets/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["vendor/core/core/datatable/css/table"], () => (__webpack_require__("./packages/core/datatable/resources/assets/sass/table.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;