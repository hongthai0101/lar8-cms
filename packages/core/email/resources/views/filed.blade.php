<div class="row">
    <div class="col-6">
        <button type="button" class="btn btn-accent btn-updated-field" data-url="{{$fieldUrl}}">@lang('Update Field')</button>
    </div>
    <div class="col-6" style="text-align: end">
        <button type="button" class="btn btn-accent btn-updated-field">@lang('Test Send')</button>
    </div>
</div>

@push('footer')
    {!! Form::modalAction(
    'updated-field',
    'Test',
    'info',
    view('core/email::updated-field', compact('replaces', 'models')),
    'updated_action_id',
    __('Save')
    ) !!}
    @push('javascript')
        <script type = "text/javascript">
            $( document ).ready(function() {
                $('.btn-updated-field').off().on('click', function () {
                    $('#updated-field').modal('show')
                });

                $('.select-update-field').off().on('change', function () {
                    var selected = $(this).find(":selected")
                    var fillable = selected.data('fillable');
                    var el = $(this).closest('tr').find('.select-fillable');
                    el.find('option').remove().end();
                    for (let i = 0; i < fillable.length; i++) {
                        el.append('<option value="' + fillable[i] + '">' + fillable[i] + '</option>');
                    }
                });

                $('#updated_action_id').off().on('click', function () {
                    var url = $('.btn-updated-field').data('url');
                    var form = $('#form-mail-template-update-field');
                    BaseGlobal._callAjax(
                        url,
                        'POST',
                        {data: form.serializeArray()},
                        () => $('#updated-field').modal('hide'),
                        () => alert(1111)
                );

                });
            });
        </script>
    @endpush

@endpush
