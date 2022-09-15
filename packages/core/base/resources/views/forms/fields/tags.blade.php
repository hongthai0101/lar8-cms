@php
    $values = isset($options['value']) && is_array($options['value']) ? $options['value'] : [];
@endphp
@if ($showField)
    @isset($options['choices'])
        <div class="m-form__group form-group">
            <div class="m-checkbox-inline">
                @foreach($options['choices'] as $key => $label)
                    <label class="m-checkbox m-checkbox--state-success">
                        {!! Form::checkbox($name, $key, in_array($key, $values)) !!}
                        <span></span>
                        {{$label}}
                    </label>
                @endforeach
                @include('core/base::forms.partials.help-block')
            </div>
        </div>
    @endisset
@endif
@include('core/base::forms.partials.errors')
