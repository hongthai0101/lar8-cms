@php
    use Illuminate\Support\Arr;
    $edit = Arr::first($args, function ($value, $key) {
        return Arr::get($value, 'type') == 'edit';
    });
    $destroy = Arr::first($args, function ($value, $key) {
        return Arr::get($value, 'type') == 'destroy';
    });
    $show = Arr::first($args, function ($value, $key) {
        return Arr::get($value, 'type') == 'show';
    });
@endphp

@if($destroy || $show)
<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
      <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @if($destroy)
            <button
                    class="dropdown-item dataTable-destroy-item"
                    data-wrapper-id="{{$tableId}}_wrapper"
                    data-url="{{Arr::get($destroy, 'route')}}">
                <i class="flaticon-delete-1"></i>
                @lang('Destroy Item')
            </button>
        @endif
        @if($show)
            <a class="dropdown-item" href="{{Arr::get($show, 'route')}}"><i class="flaticon-information"></i>@lang('Show Item')</a>
        @endif
    </div>
</span>
@endif

@if($edit)
<a href="{{Arr::get($edit, 'route')}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
    <i class="la la-edit"></i>
</a>
@endif