/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./packages/core/base/resources/assets/js/user.js ***!
  \********************************************************/
var BaseUser = function () {
  var userDatatable = '.users-table';
  var editUserRole = '.edit-user-role';

  var initBootstrapEditable = function initBootstrapEditable() {
    if ($(userDatatable).length > 0) {
      $.fn.editable.defaults.mode = 'inline';
      $.fn.editableform.buttons = '<button type="submit" class="btn btn-primary btn-sm editable-submit">' + '<i class="fa fa-fw fa-check"></i>' + '</button>' + '<button type="button" class="btn btn-warning btn-sm editable-cancel">' + '<i class="fa fa-fw fa-times"></i>' + '</button>';
      $(editUserRole).editable({
        type: 'select',
        source: [{
          value: 1,
          text: 'Male'
        }, {
          value: 2,
          text: 'Female'
        }],
        url: '{{url("contacts/update")}}',
        title: 'Update',
        success: function success(response, newValue) {
          console.log('Updated', response);
        }
      });
    }
  };

  return {
    init: function init() {
      initBootstrapEditable();
    }
  };
}();

$(document).ready(function () {
  BaseUser.init();
});
/******/ })()
;