<x-portlet title="{{__('Action')}}">
    <div class="row">
        <div class="col-6">
            <button type="submit" class="btn btn-accent">@lang('Submit')</button>
        </div>
        <div class="col-6" style="text-align: end">
            <a href="{{$route ?? '/'}}" class="btn btn-warning">@lang('Cancel')</a>
        </div>
    </div>
</x-portlet>
