<?php

namespace Messi\Media\Http\Controllers;

use Messi\Media\Chunks\Exceptions\UploadMissingFileException;
use Messi\Media\Chunks\Handler\DropZoneUploadHandler;
use Messi\Media\Chunks\Receiver\FileReceiver;
use Messi\Media\Repositories\Interfaces\MediaFileInterface;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Media;
use Storage;
use Validator;

/**
 * @since 19/08/2015 07:50 AM
 */
class MediaFileController extends Controller
{
    /**
     * @var MediaFileInterface
     */
    protected MediaFileInterface $fileRepository;

    /**
     * @param MediaFileInterface $fileRepository
     */
    public function __construct(MediaFileInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function postUpload(Request $request): JsonResponse
    {
        if (!config('core.media.media.chunk.enabled')) {
            $result = Media::handleUpload(Arr::first($request->file('file')), $request->input('folder_id', 0));

            return $this->handleUploadResponse($result);
        }

        try {
            // Create the file receiver
            $receiver = new FileReceiver('file', $request, DropZoneUploadHandler::class);
            // Check if the upload is success, throw exception or return response you need
            if ($receiver->isUploaded() === false) {
                throw new UploadMissingFileException;
            }
            // Receive the file
            $save = $receiver->receive();
            // Check if the upload has finished (in chunk mode it will send smaller files)
            if ($save->isFinished()) {
                $result = Media::handleUpload($save->getFile(), $request->input('folder_id', 0));

                return $this->handleUploadResponse($result);
            }
            // We are in chunk mode, lets send the current progress
            $handler = $save->handler();

            return response()->json([
                'done'   => $handler->getPercentageDone(),
                'status' => true,
            ]);
        } catch (Exception $exception) {
            return Media::responseError($exception->getMessage());
        }
    }

    /**
     * @param array $result
     * @return JsonResponse
     */
    protected function handleUploadResponse(array $result): JsonResponse
    {
        if ($result['error'] == false) {
            return Media::responseSuccess([
                'id'  => $result['data']->id,
                'src' => Media::url($result['data']->url),
            ]);
        }

        return Media::responseError($result['message']);
    }

    /**
     * @param Request $request
     * @return ResponseFactory|JsonResponse|Response
     */
    public function postUploadFromEditor(Request $request): Response|JsonResponse|ResponseFactory
    {
        return Media::uploadFromEditor($request);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postDownloadUrl(Request $request): mixed
    {
        $validator = Validator::make($request->input(), [
            'url' => 'required',
        ]);

        if ($validator->fails()) {
            return Media::responseError($validator->messages()->first());
        }

        $result = Media::uploadFromUrl($request->input('url'), $request->input('folderId'));

        if ($result['error'] == false) {
            return Media::responseSuccess([
                'id'        => $result['data']->id,
                'src'       => Storage::url($result['data']->url),
                'url'       => $result['data']->url,
                'message'   => trans('core/media::media.javascript.message.success_header')
            ]);
        }

        return Media::responseError($result['message']);
    }
}
