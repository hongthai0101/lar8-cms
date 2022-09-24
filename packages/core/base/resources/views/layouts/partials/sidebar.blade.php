@php
	use Illuminate\Support\Arr;
	use Illuminate\Support\Str;
	use Illuminate\Support\Facades\Request;

	$sidebars = [];
	foreach (config('core.base.base.theme.sidebar') as $item) {
		if ( !empty($item) ) {
			$sidebars = array_merge($sidebars, ${$item});
		}
	}
    $sidebars = collect($sidebars)->sortBy('position')->toArray();

	$route = Request::route();
	$currentRoute = $route->getName();
@endphp
<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
	@foreach($sidebars as $key => $sidebar)
		@php
			$title = Arr::get($sidebar, 'title');
            $url = Arr::get($sidebar, 'url');
            $permissions = Arr::get($sidebar, 'permissions');
            $subs = Arr::get($sidebar, 'subs');
            $icon = Arr::get($sidebar, 'icon');
            $selected = Arr::get($sidebar, 'selected');
            $isSelected = Str::startsWith($currentRoute, $selected);
		@endphp
		@if($url && auth()->user()->canAtLeast($permissions))
			<li class="m-menu__item {{$isSelected ? 'm-menu__item--active' : ''}}">
				<a  href="{{$url}}" class="m-menu__link">
					<i class="m-menu__link-icon {{$icon}}"></i>
					<span class="m-menu__link-text">{{$title}}</span>
				</a>
			</li>
		@elseif(!$url && auth()->user()->canAtLeast($permissions))
			@if(!empty($subs))
				<li class="m-menu__item  m-menu__item--submenu {{$isSelected ? 'm-menu__item--open m-menu__item--expanded' : ''}}">
					<a  href="javascript:;" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon {{$icon}}"></i>
						<span class="m-menu__link-text">{{$title}}</span>
						<i class="m-menu__ver-arrow la la-angle-right"></i>
					</a>
					<div class="m-menu__submenu ">
						<span class="m-menu__arrow"></span>
						<ul class="m-menu__subnav">
							<li class="m-menu__item  m-menu__item--parent">
								<span class="m-menu__link">
									<span class="m-menu__link-text">
										{{$title}}
									</span>
								</span>
							</li>
							@foreach($subs as $k => $sub)
								@php
									$title = Arr::get($sub, 'title');
                                    $url = Arr::get($sub, 'url');
                                    $permissions = Arr::get($sub, 'permissions');
                                    $selected = Arr::get($sub, 'selected');
                                    $isSelected = Str::startsWith($currentRoute, $selected);
								@endphp
								@canAtLeast($permissions)
								<li class="m-menu__item {{$isSelected ? 'm-menu__item--active' : ''}}">
									<a  href="{{$url}}" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text">
											{{$title}}
										</span>
									</a>
								</li>
								@endCanAtLeast
							@endforeach
						</ul>
					</div>
				</li>
			@endif
		@endif
	@endforeach
</ul>
