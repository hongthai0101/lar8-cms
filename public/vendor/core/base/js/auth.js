/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************************!*\
  !*** ./packages/core/base/resources/assets/js/auth.js ***!
  \********************************************************/
var BaseAuth = function () {
  var btnAvatar = '#avatar';
  var modalAvatar = '#image-modal';
  var btnLoad = '#btn-load';
  var divUpload = '#div-upload';
  var inputImage = '#image';
  var btnUpload = '#btn-upload';

  var showModalAvatar = function showModalAvatar() {
    $(btnAvatar).off('click').on('click', function () {
      $(modalAvatar).modal('show');
    });
    $(btnLoad).off('click').on('click', function () {
      $(inputImage).click();
    });
  };

  var uploadAvatar = function uploadAvatar() {
    var resize = $(divUpload).croppie({
      enableExif: true,
      enableOrientation: true,
      viewport: {
        width: 200,
        height: 200,
        type: 'circle'
      },
      boundary: {
        width: 300,
        height: 300
      }
    });
    $(inputImage).on('change', function () {
      var reader = new FileReader();

      reader.onload = function (e) {
        resize.croppie('bind', {
          url: e.target.result
        }).then(function () {
          console.log('jQuery bind complete');
        });
      };

      reader.readAsDataURL(this.files[0]);
    });
    $(btnUpload).on('click', function (ev) {
      resize.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function (img) {
        BaseGlobal._callAjax($(btnUpload).data('url'), 'POST', {
          "image": img
        });

        window.location.reload(true);
      });
    });
  };

  return {
    init: function init() {
      uploadAvatar();
      showModalAvatar();
    }
  };
}();

$(document).ready(function () {
  BaseAuth.init();
});
/******/ })()
;