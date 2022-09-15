@extends('core/base::layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="m-portlet m-portlet--full-height">
                <div class="m-portlet__body">
                    <div class="m-card-profile">
                        <div class="m-card-profile__pic">
                            <div class="m-card-profile__pic-wrapper">
                                <img id="avatar" src="{{$item->avatar}}" alt="{{$item->name}}"/>
                            </div>
                        </div>
                        <div class="m-card-profile__details">
                            <span class="m-card-profile__name">
                            {{$item->name}}
                            </span>
                            <a href="" class="m-card-profile__email m-link">
                                {{$item->email}}
                            </a>
                        </div>
                    </div>
                    <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                        <li class="m-nav__separator m-nav__separator--fit"></li>
                        <li class="m-nav__item">
                            <a href="javascript;" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-exclamation-1"></i>
                                <span class="m-nav__link-text">
                        {{$item->phone}}
                    </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__item m-tabs__link active" data-toggle="tab" href="#auth_profile_tab" role="tab">
                                    <i class="flaticon-share m--hide"></i>
                                    @lang('Profile')
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#auth_password_tab" role="tab">
                                    @lang('Reset Password')
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="auth_profile_tab">
                        <form class="m-form m-form--fit m-form--label-align-right fr-validate" method="POST" action="{{route('admin.users.update', $item->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label for="auth-role-id" class="col-2 col-form-label">
                                        @lang('Role')
                                    </label>
                                    <div class="col-7">
                                        <select class="form-control m-input" id="auth-role-id" name="role_id">
                                            @foreach($roles as $k => $val)
                                                <option value="{{$k}}" @if($roleId == $k) selected @endif>{{$val}}</option>
                                            @endforeach
                                        </select>
                                        <span class="m-form__help">{{$errors->first('phone')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-7">
                                            <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                @lang('Submit')
                                            </button>
                                            &nbsp;&nbsp
                                            <a href="{{route('admin.users.index')}}" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                @lang('Cancel')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="auth_password_tab">
                        <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{route('admin.users.update', $item->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        @lang('Password')
                                    </label>
                                    <div class="col-7">
                                        <input
                                                class="form-control m-input"
                                                name="password"
                                                type="password"
                                                required
                                                data-rule-minlength="6",
                                        />
                                        <span class="m-form__help">{{$errors->first('password')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-7">
                                            <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                @lang('Submit')
                                            </button>
                                            &nbsp;&nbsp;
                                            <a href="{{route('admin.users.index')}}" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                @lang('Cancel')
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop