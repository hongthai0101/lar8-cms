<div class="m-form__group form-group row">
    <input type="hidden" name="{{ $name }}" value="0">
    <div class="col-3">
        <span class="m-switch m-switch--outline m-switch--icon m-switch--success">
            <label>
                <input type="checkbox" name="{{ $name }}" class="onoffswitch-checkbox" id="{{ $name }}" value="1" @if ($value) checked @endif {!! Html::attributes($attributes) !!}>
                <span></span>
            </label>
        </span>
    </div>
</div>