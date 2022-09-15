@if ($showStart)
    {!! Form::open(Arr::except($formOptions, ['template'])) !!}
@endif

@if ($showFields)
    @foreach ($fields as $field)
        @if (!in_array($field->getName(), $exclude))
            {!! $field->render() !!}
            @if ($field->getName() == 'name' && defined('BASE_FILTER_SLUG_AREA'))
            @endif
        @endif
    @endforeach
@endif
<div class="clearfix"></div>


{!! $form->getActionButtons() !!}

@if ($showEnd)
    {!! Form::close() !!}
@endif

@if ($form->getValidatorClass())
    @push('footer')
        {!! $form->renderValidatorJs() !!}
    @endpush
@endif

