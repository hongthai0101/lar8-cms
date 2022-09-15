var BaseAuth = function () {

    const btnAvatar = '#avatar';
    const modalAvatar = '#image-modal';
    const btnLoad = '#btn-load';
    const divUpload = '#div-upload';
    const inputImage = '#image';
    const btnUpload = '#btn-upload';

    const showModalAvatar = function() {
        $(btnAvatar).off('click').on('click', function () {
            $(modalAvatar).modal('show');
        });

        $(btnLoad).off('click').on('click', function () {
            $(inputImage).click();
        });
    };

    const uploadAvatar = function () {
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
                resize.croppie('bind',{
                    url: e.target.result
                }).then(function(){
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
                BaseGlobal._callAjax(
                    $(btnUpload).data('url'),
                    'POST',
                    {"image":img}
                );
                window.location.reload(true);
            });
        });
    };

    return {
        init: function init() {
            uploadAvatar();
            showModalAvatar();
        }
    }
}();

$(document).ready(function() {
    BaseAuth.init();
});