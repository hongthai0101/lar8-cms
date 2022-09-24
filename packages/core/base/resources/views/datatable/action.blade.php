@php
    use Illuminate\Support\Arr;
    $edit = Arr::first($args, function ($value, $key) {
        return Arr::get($value, 'type') == 'edit';
    });
    $isPermissionEdit = (!empty($edit['permission']) && auth()->user()->canAtLeast($edit['permission']));

    $destroy = Arr::first($args, function ($value, $key) {
        return Arr::get($value, 'type') == 'destroy';
    });
    $isPermissionDestroy = (!empty($destroy['permission']) && auth()->user()->canAtLeast($destroy['permission']));

    $show = Arr::first($args, function ($value, $key) {
        return Arr::get($value, 'type') == 'show';
    });
    $isPermissionShow = (!empty($show['permission']) && auth()->user()->canAtLeast($show['permission']));
@endphp

@if(($destroy && $isPermissionDestroy) || ($show && $isPermissionShow))
<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
      <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @if($destroy && $isPermissionDestroy)
            <button
                    class="dropdown-item dataTable-destroy-item"
                    data-wrapper-id="{{$tableId}}_wrapper"
                    data-url="{{Arr::get($destroy, 'route')}}">
                <i class="flaticon-delete-1"></i>
                @lang('Destroy Item')
            </button>
        @endif
        @if($show && $isPermissionShow)
            <a class="dropdown-item" href="{{Arr::get($show, 'route')}}"><i class="flaticon-information"></i>@lang('Show Item')</a>
        @endif
    </div>
</span>
@endif
@if($edit && $isPermissionEdit)
<a href="{{Arr::get($edit, 'route')}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
    <i class="la la-edit"></i>
</a>
@endif
