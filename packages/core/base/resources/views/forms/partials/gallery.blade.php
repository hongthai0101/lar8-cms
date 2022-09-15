{!! Form::hidden('gallery', $value ? json_encode($value) : null, ['id' => 'gallery-data', 'class' => 'form-control']) !!}
<div>
    <div class="list-photos-gallery">
        <div class="row" id="list-photos-items">
            @if (!empty($value))
                @foreach ($value as $key => $item)
                    <div class="col-md-2 col-sm-3 col-4 photo-gallery-item" data-id="{{ $key }}" data-img="{{ Arr::get($item, 'img') }}" data-description="{{ Arr::get($item, 'description') }}">
                        <div class="gallery_image_wrapper">
                            <img src="{{ Media::getImageUrl(Arr::get($item, 'img'), 'thumb') }}" alt="{{ __('Gallery') }}">
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
        <a href="#" class="btn_select_gallery">{{ __('Select image') }}</a>&nbsp;
        <a href="#" class="text-danger reset-gallery @if (empty($value)) hidden @endif">{{ __('Reset') }}</a>
    </div>
</div>

<div id="edit-gallery-item" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title"><i class="til_img"></i><strong>{{ __('Update description') }}</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body with-padding">
                <p><input type="text" class="form-control" id="gallery-item-description" placeholder="{{ __('Gallery') }}"></p>
            </div>

            <div class="modal-footer">
                <button class="float-left btn btn-danger" id="delete-gallery-item" href="#">{{ __('Remove') }}</button>
                <button class="float-right btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button class="float-right btn btn-primary" id="update-gallery-item">{{ __('Update') }}</button>
            </div>
        </div>
    </div>
</div>

@push('header')
    <link href="{{ mix('/vendor/core/base/css/gallery.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('javascript')
    <script src="https://cms.botble.com/vendor/core/core/base/libraries/sortable/sortable.min.js?v=5.19.3" type="text/javascript"></script>
    <script src="{{mix('/vendor/core/base/js/gallery.js')}}" type="text/javascript"></script>
@endpush