@extends('core/base::layouts.master')
@section('content')
    @if ($showStart)
        {!! Form::open(Arr::except($formOptions, ['template'])) !!}
    @endif
        <div class="row">
            <div class="col-md-9">
                <x-portlet>
                        @if ($showFields && $form->hasMainFields())
                            @foreach ($fields as $key => $field)
                                @if ($field->getName() == $form->getBreakFieldPoint())
                                    @break
                                @else
                                    @unset($fields[$key])
                                @endif
                                @if (!in_array($field->getName(), $exclude))
                                    {!! $field->render() !!}
                                @endif
                            @endforeach
                            <div class="clearfix"></div>
                        @endif
                </x-portlet>
                {{--@if($form->getMetaBox())--}}
                    {{--{{ $form->renderMetaBox() }}--}}
                {{--@endif--}}
                {!! $form->renderMetaBoxes() !!}
                {{--@foreach ($form->getMetaBoxes() as $key => $metaBox)--}}
                    {{--@dd($key)--}}
                    {{--{!! $form->getMetaBox($key) !!}--}}
                {{--@endforeach--}}

            </div>
            <div class="col-md-3">
                {!! $form->getActionButtons($form->getCancelUrl()) !!}
                @foreach ($fields as $field)
                    @if (!in_array($field->getName(), $exclude))
                        <x-portlet title="{{Form::customLabel($field->getName(), $field->getOption('label'), $field->getOption('label_attr'))}}">
                            {!! $field->render([], in_array($field->getType(), ['radio', 'checkbox'])) !!}
                        </x-portlet>
                    @endif
                @endforeach
            </div>
        </div>
    @if ($showEnd)
        {!! Form::close() !!}
    @endif

@stop
@if ($form->getValidatorClass())
    @push('javascript')
        <script src="{{ asset('vendor/core/js-validation/js/js-validation.js') }}" type="text/javascript"></script>
        {!! $form->renderValidatorJs() !!}
    @endpush
@endif
