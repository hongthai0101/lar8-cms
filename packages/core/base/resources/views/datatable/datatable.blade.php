<div class="m-portlet m-portlet--mobile m-portlet--head-solid-bg m-portlet--head-sm">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ $title }}
                </h3>
            </div>
        </div>
    </div>

    <div class="m-portlet__body">
        {{$dataTable->table([], true)}}
    </div>
</div>
@include('core/base::datatable.modal.destroy')

@push('header')
    <link rel="stylesheet" href="{{asset('vendor/core/base')}}/metronic/assets/vendors/custom/datatables/datatables.bundle.css">
@endpush

@push('javascript')
    <script src="{{asset('vendor/core/base')}}/metronic/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {{$dataTable->scripts()}}
@endpush