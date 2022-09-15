@extends('core/base::layouts.master')
@php($authProfile = true)
@if ($errors->has('old_password') || $errors->has('password'))
    @php($authProfile = false)
@endif
@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            @include('core/base::auth.includes.left_profile')
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__item m-tabs__link @if($authProfile) active @endif" data-toggle="tab" href="#auth_profile_tab" role="tab">
                                    <i class="flaticon-share m--hide"></i>
                                    @lang('Profile')
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link @if(!$authProfile) active @endif" data-toggle="tab" href="#auth_password_tab" role="tab">
                                    @lang('Password')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    @include('core/base::auth.includes.form.profile')
                    @include('core/base::auth.includes.form.password')
                </div>
            </div>
        </div>
    </div>
    @include('core/base::auth.includes.modal_avatar')
@stop

@push('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
@endpush

@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script src="{{asset('vendor/core/base/js/auth.js')}}" type="text/javascript"> </script>
@endpush