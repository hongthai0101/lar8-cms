@php
$attributes['class'] = Arr::get($attributes, 'class', '') . ' form-control editor-ckeditor';
$attributes['id'] = Arr::get($attributes, 'id', $name);
$attributes['rows'] = Arr::get($attributes, 'rows', 4);
@endphp

{!! Form::textarea($name, htmlentities($value), $attributes) !!}
