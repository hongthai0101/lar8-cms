@if (!(isset($attributes['without-buttons']) && $attributes['without-buttons'] == true))
    <div style="height: 34px;">
        @php $result = !empty($attributes['id']) ? $attributes['id'] : $name; @endphp
        <span class="editor-action-item">
            <a href="#" class="btn_gallery btn btn-primary"
               data-result="{{ $result }}"
               data-multiple="true"
               data-action="media-insert-tinymce">
                <i class="fa fa-file-image-o"></i> {{ __('Add media') }}
            </a>
        </span>
    </div>
    <div class="clearfix"></div>
@endif
@php
    $attributes['class'] = Arr::get($attributes, 'class', '') . ' form-control editor-tinymce';
    $attributes['id'] = Arr::get($attributes, 'id', $name);
    $attributes['rows'] = Arr::get($attributes, 'rows', 4);
@endphp

{!! Form::textarea($name, htmlentities($value), $attributes) !!}

@push('javascript')
    <script src="{{asset('vendor/core/base/libraries/tinymce/js/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/core/base/js/editor.js')}}" type="text/javascript"></script>
@endpush