<div class="tab-pane @if($authProfile) active @endif" id="auth_profile_tab">
    <form class="m-form m-form--fit m-form--label-align-right fr-validate" method="POST" action="{{route('admin.auth.profile')}}">
        @csrf
        @method('PUT')
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                    @lang('Fullname')
                </label>
                <div class="col-7">
                    <input
                            class="form-control m-input"
                            type="text"
                            value="{{old('name') ? old('name') : $item->name}}"
                            name="name"
                            required
                    />
                    <span class="m-form__help">{{$errors->first('name')}}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="example-text-input" class="col-2 col-form-label">
                    @lang('Phone')
                </label>
                <div class="col-7">
                    <input
                            class="form-control m-input"
                            type="text"
                            value="{{old('phone') ? old('phone') : $item->phone}}"
                            name="phone"
                            required
                            data-rule-minlength="10"
                    />
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
                        &nbsp;&nbsp;
                        <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                            @lang('Cancel')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>