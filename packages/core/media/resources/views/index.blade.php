@extends('core/base::layouts.master')

@push('header')
    {!! Media::renderHeader() !!}
@endpush

@section('content')
    {!! Media::renderContent() !!}
@endsection

@push('javascript')
    {!! Media::renderFooter() !!}
@endpush