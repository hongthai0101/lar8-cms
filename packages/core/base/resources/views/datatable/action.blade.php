@php
    use Illuminate\Support\Arr;
    $edit = Arr::first($args, function ($value, $key) {
        return Arr::get($value, 'type') == 'edit';
    });
    $isPermissionEdit = (!empty($edit['permission']) && auth()->user()->canAtLeast($edit['permission']));
    $isEditDisplay = Arr::get($edit, 'isDisplay', true);

    $destroy = Arr::first($args, function ($value, $key) {
        return Arr::get($value, 'type') == 'destroy';
    });
    $isPermissionDestroy = (!empty($destroy['permission']) && auth()->user()->canAtLeast($destroy['permission']));
    $isDestroyDisplay = Arr::get($destroy, 'isDisplay', true);

    $show = Arr::first($args, function ($value, $key) {
        return Arr::get($value, 'type') == 'show';
    });
    $isPermissionShow = (!empty($show['permission']) && auth()->user()->canAtLeast($show['permission']));
    $isShowDisplay = Arr::get($show, 'isDisplay', true);
@endphp

@if(($destroy && $isPermissionDestroy && $isDestroyDisplay) || ($show && $isPermissionShow && $isShowDisplay))
<span class="dropdown">
    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
      <i class="la la-ellipsis-h"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        @if($destroy && $isPermissionDestroy && $isDestroyDisplay)
            <button
                    class="dropdown-item dataTable-destroy-item"
                    data-wrapper-id="{{$tableId}}_wrapper"
                    data-url="{{Arr::get($destroy, 'route')}}">
                <i class="flaticon-delete-1"></i>
                @lang('Destroy Item')
            </button>
        @endif
        @if($show && $isPermissionShow && $isShowDisplay)
            <a class="dropdown-item" href="{{Arr::get($show, 'route')}}"><i class="flaticon-information"></i>@lang('Show Item')</a>
        @endif
    </div>
</span>
@endif
@if($edit && $isPermissionEdit && $isEditDisplay)
<a href="{{Arr::get($edit, 'route')}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
    <i class="la la-edit"></i>
</a>
@endif
