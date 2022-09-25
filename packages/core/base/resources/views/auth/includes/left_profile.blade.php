<div class="m-portlet m-portlet--full-height">
    <div class="m-portlet__body">
        <div class="m-card-profile">
            <div class="m-card-profile__title m--hide">
                @lang('Your Profile')
            </div>
            <div class="m-card-profile__pic">
                <div class="m-card-profile__pic-wrapper">
                    <img id="avatar" src="{{\Storage::url($item->avatar)}}" alt="{{$item->name}}"/>
                </div>
            </div>
            <div class="m-card-profile__details">
            <span class="m-card-profile__name">
            {{$item->name}}
            </span>
                <a href="" class="m-card-profile__email m-link">
                    {{$item->email}}
                </a>
            </div>
        </div>
        <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
            <li class="m-nav__separator m-nav__separator--fit"></li>
            <li class="m-nav__item">
                <a href="javascript;" class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-exclamation-1"></i>
                    <span class="m-nav__link-text">
                        {{$item->phone}}
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
