<?php

namespace Messi\Base\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Messi\Base\Http\Requests\Api\AuthRequest;
use Messi\Base\Http\Resources\CategoryResource;
use Messi\Base\Repositories\Contracts\UserRepository;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;

class AuthController extends ApiController
{
    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * Create a new AuthController instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @OA\Post (
     *     path="/api/v1/auth/login",
     *     tags={"Auth"},
     *     summary="Đăng nhập",
     *     description="Trả về token và thời gian hết hạn",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/LoginResponseSchema"
     *          ),
     *       ),
     * )
     *
     * Get a JWT via given credentials.
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->error(['message' => 'Login credentials are invalid.'], 400);
            }
        } catch (JWTException $e) {
            return $this->error(['message' => 'Could not create token.'], 500);
        }
        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post (
     *     path="/api/v1/auth/register",
     *     tags={"Auth"},
     *     summary="Register",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/RegisterResponseSchema"
     *          ),
     *       ),
     * )
     *
     * Register a User.
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function register(AuthRequest $request): JsonResponse
    {
        $user = $this->repository->create($request->validated());
        return $this->successCreated($user->toArray());
    }

    /**
     * @OA\Post (
     *     path="/api/v1/auth/logout",
     *     tags={"Auth"},
     *     summary="Logout",
     *     security={{"bearerToken":{}}},
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *          @OA\JsonContent(),
     *       ),
     * )
     *
     * Log the user out (Invalidate the token).
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function logout(AuthRequest $request): JsonResponse
    {
        try {
            JWTAuth::invalidate($request->token);
            return $this->successNotContent();
        } catch (JWTException $exception) {
            return $this->error(['message' => 'Sorry, user cannot be logged out'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post (
     *     path="/api/v1/auth/refresh",
     *     tags={"Auth"},
     *     summary="Refresh",
     *     security={{"bearerToken":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/LoginResponseSchema"),
     *       ),
     * )
     *
     * Refresh a token.
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * @OA\Get (
     *     path="/api/v1/auth/profile",
     *     tags={"Auth"},
     *     summary="Profile",
     *     security={{"bearerToken":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ProfileResource"),
     *       ),
     * )
     *
     * Get the authenticated User.
     * @return CategoryResource
     */
    public function profile(): CategoryResource
    {
        return new CategoryResource(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return $this->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
