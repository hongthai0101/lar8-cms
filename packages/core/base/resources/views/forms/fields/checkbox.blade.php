@if ($showLabel && $showField)
    <label class="m-checkbox">
        {!! Form::checkbox($name, $choice['id']) !!}
        <span></span>
        {{$showLabel}}
    </label>
@endif
