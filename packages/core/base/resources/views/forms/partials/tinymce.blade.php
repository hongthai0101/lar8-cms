@php
    $attributes['class'] = Arr::get($attributes, 'class', '') . ' form-control editor-tinymce';
    $attributes['id'] = Arr::get($attributes, 'id', $name);
    $attributes['rows'] = Arr::get($attributes, 'rows', 4);
@endphp

{!! Form::textarea($name, htmlentities($value), $attributes) !!}

@push('javascript')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('vendor/core/base/js/editor.js')}}" type="text/javascript"></script>
@endpush