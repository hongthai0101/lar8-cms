<div class="row">
    <div class="col-6">
        <button type="button" class="btn btn-accent btn-update-field" data-url="{{$fieldUrl}}">@lang('Update Field')</button>
    </div>
</div>

@push('footer')
    {!! Form::modalAction(
    'modal-update-field',
    __('Map Filed To Content'),
    'info',
    view('core/email::updated-field', compact('replaces', 'models', 'fields')),
    'updated_action_id',
    __('Save')
    ) !!}
@endpush
@push('javascript')
    <script type = "text/javascript">
        $( document ).ready(function() {
            $('.btn-update-field').off().on('click', function () {
                $('#modal-update-field').modal('show')
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
                var url = $('.btn-update-field').data('url');
                var form = $('#form-mail-template-update-field');
                BaseGlobal._callAjax(
                    url,
                    'POST',
                    {data: form.serializeArray()},
                    () => $('#modal-update-field').modal('hide'),
                    () => alert('Something went wrong!')
                );
            });
        });
    </script>
@endpush


