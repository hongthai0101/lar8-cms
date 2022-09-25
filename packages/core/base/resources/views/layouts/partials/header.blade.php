<div class="m-container m-container--fluid m-container--full-height">
    <div class="m-stack m-stack--ver m-stack--desktop">
        <div class="m-stack__item m-brand  m-brand--skin-dark ">
            <div class="m-stack m-stack--ver m-stack--general">
                <div class="m-stack__item m-stack__item--middle m-brand__logo">
                    <a href="{{route('admin.dashboard.index')}}" class="m-brand__logo-wrapper">
                        <img height="15px" width="auto" alt="{{setting('__admin_title__')}}" src="{{ get_image_url(setting('__admin_logo__')) }}"/>
                    </a>
                </div>
                <div class="m-stack__item m-stack__item--middle m-brand__tools">
                    <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block
					 ">
                        <span></span>
                    </a>
                    <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                        <span></span>
                    </a>
                    <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                        <span></span>
                    </a>
                    <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                        <i class="flaticon-more"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
            <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
                <i class="la la-close"></i>
            </button>
            <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                <div class="m-stack__item m-topbar__nav-wrapper">
                    <ul class="m-topbar__nav m-nav m-nav--inline">
                        <li class="m-nav__item m-topbar__languages m-dropdown m-dropdown--small m-dropdown--arrow m-dropdown--align-right m-dropdown--mobile-full-width" m-dropdown-toggle="click" aria-expanded="true">
                            <a href="javascript:void(0);" class="m-nav__link m-dropdown__toggle">
                                    <span class="m-topbar__userpic pr-2">
                                        <img alt="" class="m--img-rounded m--marginless" src="{{\Storage::url(auth()->user()->avatar)}}">
                                    </span>
                                <span class="m-nav__link-text username">
                                        {{auth()->user()->name}}
                                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                                    </span>
                            </a>
                            <div class="m-dropdown__wrapper" style="z-index: 101;">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 41.5px;"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav m-nav--skin-light">
                                                <li class="m-nav__item">
                                                    <a href="{{route('admin.auth.profile')}}" class="m-nav__link" id="admin-bar-edit-profile">
                                                        <i class="m-nav__link-icon icon-user"></i>
                                                        <span class="m-nav__link-text">@lang('Profile')</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li id="m_quick_sidebar_toggle" class="m-nav__item" title="@lang('Logout')">
                            <a  class="m-nav__link m-dropdown__toggle" href="javascript;"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span class="m-nav__link-icon">
                                <i class="flaticon-logout"></i>
                        </span>
                            </a>
                            <form id="logout-form" action="{{ route('admin.auth.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
