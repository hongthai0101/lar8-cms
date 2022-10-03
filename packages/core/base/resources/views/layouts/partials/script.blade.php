<script src="{{asset('vendor/core/base/metronic')}}/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="{{asset('vendor/core/base/metronic')}}/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="{{ asset('vendor/core/base/js') }}/app.js" type="text/javascript"></script>
<script type="text/javascript">
    var BASE_URL = '{{url('')}}';
    $(document).ready(function() {
        @php
            $type = session('type');
            $msg = session('msg');
        @endphp
        @if($type && $msg)
            toastr.{{ $type }}('{{$msg}}');
        @endif
    });
</script>
@include('core/media::partials.media')
@stack('javascript')
