@php
    use Illuminate\Support\Arr;
@endphp
<div class="m-portlet m-portlet--mobile m-portlet--head-solid-bg m-portlet--head-sm">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {!! Arr::get($attributes, 'title', $title) !!}
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        {{ $slot }}
    </div>
</div>