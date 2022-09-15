@php
    use Illuminate\Support\Arr;
    $values = $data->data ?? [];
@endphp
<x-portlet title="{{__('Search Engine Optimize')}} ">
    <div class="form-group m-form__group">
        <label for="seo-title">@lang('SEO Title')</label>
        <input type="text" class="form-control m-input m-input--square" id="seo-title" value="{{old('seo[title]', Arr::get($values, 'title'))}}" name="seo[title]" placeholder="@lang('Enter SEO title')">
    </div>
    <div class="form-group m-form__group">
        <label for="seo-description">
            @lang('SEO Description')
        </label>
        <textarea class="form-control m-input" name="seo[description]" id="seo-description" rows="3" placeholder="@lang('Enter SEO description')">{{old('seo[description]', Arr::get($values, 'description'))}}</textarea>
    </div>
    <span class="m-form__help">
        <h6>@lang('Setup meta title & description to make your site easy to discovered on search engines such as Google')</h6>
    </span>
</x-portlet>