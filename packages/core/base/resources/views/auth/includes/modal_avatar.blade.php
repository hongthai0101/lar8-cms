<!--begin::Modal-->
<div class="modal fade" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @lang('Avatar')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <input type="file" style="display: none" id="image">
                    <div id="div-upload"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    @lang('Close')
                </button>
                <button id="btn-load" class="btn btn-success pull-left">
                    @lang('Choose file')
                </button>
                <button id="btn-upload" class="btn btn-primary" data-url="{{route('admin.user.avatar')}}">
                    @lang('Submit')
                </button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->