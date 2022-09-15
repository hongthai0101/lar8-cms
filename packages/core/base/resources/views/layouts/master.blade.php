<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8" />
    <title>{{setting('__admin_title__', __('Admin'))}} | {{ $title ?? config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('core/base::layouts.partials.style')
</head>
<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<div class="m-grid m-grid--hor m-grid--root m-page">
    <header id="m_header" class="m-grid__item m-header"  m-minimize-offset="200" m-minimize-mobile-offset="200" >
        @include('core/base::layouts.partials.header')
    </header>
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <div
                    id="m_ver_menu"
                    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                    m-menu-vertical="1"
                    m-menu-scrollable="0" m-menu-dropdown-timeout="500"
            >
                    @include('core/base::layouts.partials.sidebar')
            </div>
        </div>
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            @include('core/base::layouts.partials.breadcrumbs')
            <div class="m-content">
                @yield('content')
            </div>
        </div>
    </div>
@include('core/base::layouts.partials.footer')
</div>

@include('core/base::layouts.partials.script')
</body>
</html>
