@extends('core/base::auth.auth')

@section('content')
    <div class="m-login__signin">
        <div class="m-login__head">
            <h3 class="m-login__title">
                Sign In To Admin
            </h3>
        </div>
        <form class="m-login__form m-form" action="{{route('admin.auth.authenticate')}}" method="POST">
            @csrf
            <div class="form-group m-form__group @error('email') has-danger @enderror">
                <input class="form-control m-input" type="email" placeholder="{{__('Email')}}" name="email" autocomplete="off">
                @error('email')
                    <div class="form-control-feedback">{{$errors->first('email')}}.</div>
                @enderror
            </div>
            <div class="form-group m-form__group @error('password') has-danger @enderror">
                <input class="form-control m-input m-login__form-input--last" required type="password" placeholder="{{__('Password')}}" name="password">
                @error('password')
                    <div class="form-control-feedback">{{$errors->first('password')}}.</div>
                @enderror
            </div>
            <div class="row m-login__form-sub">
                <div class="col m--align-left">
                    <label class="m-checkbox m-checkbox--focus">
                        <input type="checkbox" name="remember">
                        @lang('Remember me')
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="m-login__form-action">
                <button id="" type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                    Sign In
                </button>
            </div>
        </form>
    </div>
@stop