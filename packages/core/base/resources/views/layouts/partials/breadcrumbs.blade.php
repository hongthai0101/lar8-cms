@php use Illuminate\Support\Arr @endphp
@if(!empty($breadcrumbs))
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item">
                    <a href="{{route('admin.dashboard.index')}}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            @lang('Dashboard')
                        </span>
                    </a>
                </li>

                @php( $countBreadcrumbs = count($breadcrumbs) )
                    @foreach($breadcrumbs as $key => $breadcrumb)
                        <li class="m-nav__separator"> - </li>
                        @if($countBreadcrumbs != $key + 1)
                            <li class="m-nav__item">
                                <a href="{{ Arr::get($breadcrumb, 'url') }}" class="m-nav__link">
                                    <span class="m-nav__link-text">
                                        {{ Arr::get($breadcrumb, 'title') }}
                                    </span>
                                </a>
                            </li>
                        @else
                            <li class="m-nav__item">
                                <span class="m-nav__link-text">
                                    {{ Arr::get($breadcrumb, 'title') }}
                                </span>
                            </li>
                        @endif
                    @endforeach

            </ul>
        </div>
    </div>
</div>
@endif