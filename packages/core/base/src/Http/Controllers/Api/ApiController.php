<?php
namespace Messi\Base\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * @OA\Info(title="System API", version="0.1", description="System API")
 * @OA\SecurityScheme(
 *    securityScheme="bearerToken",
 *    in="header",
 *    name="bearerToken",
 *    type="http",
 *    scheme="bearer",
 *    bearerFormat="JWT",
 * ),
 */
class ApiController extends Controller
{
    /**
     * @param $data
     * @return JsonResponse
     */
    protected function success($data): JsonResponse
    {
        return response()->json($data, 200);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    protected function successCreated($data): JsonResponse
    {
        return response()->json($data, 201);
    }

    /**
     * @return JsonResponse
     */
    protected function successNotContent(): JsonResponse
    {
        return response()->json(null, 204);
    }

    /**
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    protected function error($data,int $status = 400): JsonResponse
    {
        return response()->json($data, $status);
    }
}
