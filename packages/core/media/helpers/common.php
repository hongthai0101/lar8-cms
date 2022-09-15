<?php

if (!function_exists('is_image')) {
    /**
     * Is the mime type an image
     *
     * @param string $mimeType
     * @return bool
     * @deprecated since 5.7
     */
    function is_image($mimeType)
    {
        return Media::isImage($mimeType);
    }
}

if (!function_exists('get_image_url')) {
    /**
     * @param string $url
     * @param string $size
     * @param bool $relativePath
     * @param null $default
     * @return string
     * @deprecated since 5.7
     */
    function get_image_url($url, $size = null, $relativePath = false, $default = null)
    {
        return Media::getImageUrl($url, $size, $relativePath, $default);
    }
}

if (!function_exists('get_object_image')) {
    /**
     * @param string $image
     * @param null $size
     * @param bool $relativePath
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     * @deprecated since 5.7
     */
    function get_object_image($image, $size = null, $relativePath = false)
    {
        return Media::getImageUrl($image, $size, $relativePath, Media::getDefaultImage());
    }
}

if (!function_exists('rv_media_handle_upload')) {
    /**
     * @param \Illuminate\Http\UploadedFile $fileUpload
     * @param int $folderId
     * @param string $path
     * @return array|\Illuminate\Http\JsonResponse
     * @deprecated since 5.7
     */
    function rv_media_handle_upload($fileUpload, $folderId = 0, $path = '')
    {
        return Media::handleUpload($fileUpload, $folderId, $path);
    }
}

