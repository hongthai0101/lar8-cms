
<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        Metronic | Login Page - 1
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="{{asset('vendor/core/base/metronic')}}/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendor/core/base/metronic')}}/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->
    <link rel="shortcut icon" href="{{asset('vendor/core/base/metronic')}}/assets/demo/default/media/img/logo/favicon.ico" />
</head>
<!-- end::Head -->
<!-- end::Body -->
<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
        <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
            <div class="m-stack m-stack--hor m-stack--desktop">
                <div class="m-stack__item m-stack__item--fluid">
                    <div class="m-login__wrapper">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url({{asset('vendor/core/base/metronic')}}/assets/app/media/img//bg/bg-4.jpg)">
            <div class="m-grid__item m-grid__item--middle">
                <h3 class="m-login__welcome">
                    Join Our Community
                </h3>
                <p class="m-login__msg">
                    Lorem ipsum dolor sit amet, coectetuer adipiscing
                </p>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('vendor/core/base/metronic')}}/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="{{asset('vendor/core/base/metronic')}}/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="{{asset('vendor/core/base/metronic')}}/assets/snippets/custom/pages/user/login.js" type="text/javascript"></script>
</body>
</html>
