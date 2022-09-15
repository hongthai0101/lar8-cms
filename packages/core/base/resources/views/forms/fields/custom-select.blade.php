@if ($showField)
    @if ($showLabel && $options['label'] !== false && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    @if ($showField)
        @php
            Arr::set($options['attr'], 'class', Arr::get($options['attr'], 'class'));
            $emptyVal = $options['empty_value'] ? ['' => $options['empty_value']] : null;
        @endphp
        {!! Form::customSelect($name, (array)$emptyVal + $options['choices'], $options['selected'], $options['attr']) !!}
    @endif
@endif