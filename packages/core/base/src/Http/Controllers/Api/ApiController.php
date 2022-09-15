<?php
namespace Messi\Base\Http\Controllers\Api;

use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data)
    {
        return response()->json($data, 200);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successCreated($data)
    {
        return response()->json($data, 201);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successNotContent()
    {
        return response()->json(null, 204);
    }

    /**
     * @param $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($data, $status = 400)
    {
        return response()->json($data, $status);
    }
}