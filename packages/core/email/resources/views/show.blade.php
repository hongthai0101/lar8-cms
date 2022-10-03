@extends('core/base::layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-10">
            <x-portlet>
                {!! $content !!}
            </x-portlet>
        </div>
        <div class="col-md-2">
            <x-portlet title="{{__('Test Send')}}">
                <button type="submit" class="btn btn-accent btn-test-send-mail">@lang('Test Send')</button>
            </x-portlet>
        </div>
    </div>
@stop
@push('footer')
    {!! Form::modalAction(
    'modal-test-send',
    __('Test Send Email'),
    'info',
    view('core/email::test-send', compact('fields')),
    'btn-modal-test-send',
    __('Send')
    ) !!}
@endpush
@push('javascript')
    <script type = "text/javascript">
        $( document ).ready(function() {
            $('.btn-test-send-mail').off().on('click', function (){
                $('#modal-test-send').modal('show')
            });

            $('#btn-modal-test-send').off().on('click', function (){
                var url = '{{route('admin.mail-templates.test-send', $id)}}';
                var form = $('#form-test-send-mail');
                BaseGlobal._callAjax(
                    url,
                    'POST',
                    {data: form.serializeArray()},
                    () => $('#modal-test-send').modal('hide'),
                    () => alert('Something went wrong!')
                );
            });
        });
    </script>
@endpush
