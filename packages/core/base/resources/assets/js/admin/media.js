class Media {
    constructor() {
        Media.initMediaIntegrate();
    }

    static initMediaIntegrate() {

        if (jQuery().__Media) {

            $('[data-type="rv-media-standard-alone-button"]').__Media({
                multiple: false,
                onSelectFiles: (files, $el) => {
                    $($el.data('target')).val(files[0].url);
                }
            });

            $.each($(document).find('.btn_gallery'), function (index, item) {
                $(item).__Media({
                    multiple: false,
                    filter: $(item).data('action') === 'select-image' ? 'image' : 'everything',
                    view_in: 'all_media',
                    onSelectFiles: (files, $el) => {
                        switch ($el.data('action')) {
                            case 'media-insert-ckeditor':
                                let content = '';
                                $.each(files, (index, file) => {
                                    let link = file.full_url;
                                    if (file.type === 'youtube') {
                                        link = link.replace('watch?v=', 'embed/');
                                        content += '<iframe width="420" height="315" src="' + link + '" frameborder="0" allowfullscreen></iframe><br />';
                                    } else if (file.type === 'image') {
                                        content += '<img src="' + link + '" alt="' + file.name + '" /><br />';
                                    } else {
                                        content += '<a href="' + link + '">' + file.name + '</a><br />';
                                    }
                                });

                                window.EDITOR.CKEDITOR[$el.data('result')].insertHtml(content);

                                break;
                            case 'media-insert-tinymce':
                                let html = '';
                                $.each(files, (index, file) => {
                                    let link = file.full_url;
                                    if (file.type === 'youtube') {
                                        link = link.replace('watch?v=', 'embed/');
                                        html += '<iframe width="420" height="315" src="' + link + '" frameborder="0" allowfullscreen></iframe><br />';
                                    } else if (file.type === 'image') {
                                        html += '<img src="' + link + '" alt="' + file.name + '" /><br />';
                                    } else {
                                        html += '<a href="' + link + '">' + file.name + '</a><br />';
                                    }
                                });
                                tinymce.activeEditor.execCommand('mceInsertContent', false, html);
                                break;
                            case 'select-image':
                                let firstImage = _.first(files);
                                $el.closest('.image-box').find('.image-data').val(firstImage.url);
                                $el.closest('.image-box').find('.preview_image').attr('src', firstImage.thumb);
                                $el.closest('.image-box').find('.preview-image-wrapper').show();
                                break;
                            case 'attachment':
                                let firstAttachment = _.first(files);
                                $el.closest('.attachment-wrapper').find('.attachment-url').val(firstAttachment.url);
                                $el.closest('.attachment-wrapper').find('.attachment-details').html('<a href="' + firstAttachment.full_url + '" target="_blank">' + firstAttachment.url + '</a>');
                                break;
                        }
                    }
                });
            });

            $(document).on('click', '.btn_remove_image', event => {
                event.preventDefault();
                $(event.currentTarget).closest('.image-box').find('.preview-image-wrapper').hide();
                $(event.currentTarget).closest('.image-box').find('.image-data').val('');
            });

            $(document).on('click', '.btn_remove_attachment', event => {
                event.preventDefault();
                $(event.currentTarget).closest('.attachment-wrapper').find('.attachment-details a').remove();
                $(event.currentTarget).closest('.attachment-wrapper').find('.attachment-url').val('');
            });

            new __MediaStandAlone('.js-btn-trigger-add-image', {
                filter: 'image',
                view_in: 'all_media',
                onSelectFiles: (files, $el) => {
                    let $currentBoxList = $el.closest('.gallery-images-wrapper').find('.images-wrapper .list-gallery-media-images');

                    $currentBoxList.removeClass('hidden');

                    $('.default-placeholder-gallery-image').addClass('hidden');

                    _.forEach(files, (file) => {
                        let template = $(document).find('#gallery_select_image_template').html();

                        let imageBox = template
                            .replace(/__name__/gi, $el.attr('data-name'));

                        let $template = $('<li class="gallery-image-item-handler">' + imageBox + '</li>');

                        $template.find('.image-data').val(file.url);
                        $template.find('.preview_image').attr('src', file.thumb).show();

                        $currentBoxList.append($template);
                    });
                }
            });

            new __MediaStandAlone('.images-wrapper .btn-trigger-edit-gallery-image', {
                filter: 'image',
                view_in: 'all_media',
                onSelectFiles: (files, $el) => {
                    let firstItem = _.first(files);

                    let $currentBox = $el.closest('.gallery-image-item-handler').find('.image-box');
                    let $currentBoxList = $el.closest('.list-gallery-media-images');

                    $currentBox.find('.image-data').val(firstItem.url);
                    $currentBox.find('.preview_image').attr('src', firstItem.thumb).show();

                    _.forEach(files, (file, index) => {
                        if (!index) {
                            return;
                        }
                        let template = $(document).find('#gallery_select_image_template').html();

                        let imageBox = template
                            .replace(/__name__/gi, $currentBox.find('.image-data').attr('name'));

                        let $template = $('<li class="gallery-image-item-handler">' + imageBox + '</li>');

                        $template.find('.image-data').val(file.url);
                        $template.find('.preview_image').attr('src', file.thumb).show();

                        $currentBoxList.append($template);
                    });
                }
            });

            $(document).on('click', '.btn-trigger-remove-gallery-image', event => {
                event.preventDefault();
                $(event.currentTarget).closest('.gallery-image-item-handler').remove();
                if ($('.list-gallery-media-images').find('.gallery-image-item-handler').length === 0) {
                    $('.default-placeholder-gallery-image').removeClass('hidden');
                }
            });

            $('.list-gallery-media-images').each((index, item) => {
                if (jQuery().sortable) {
                    let $current = $(item);
                    if ($current.data('ui-sortable')) {
                        $current.sortable('destroy');
                    }
                    $current.sortable();
                }
            });
        }
    }
}

$(document).ready(() => {
    new Media();
    window.Media = Media;
});
