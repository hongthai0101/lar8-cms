<?php

namespace Messi\Base\Http\Controllers\Api;


use Messi\Base\Http\Requests\Api\AuthRequest;
use Messi\Base\Repositories\Contracts\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthController extends ApiController
{
    /**
     * @var UserRepository
     */
    private $repository;

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
     * Get a JWT via given credentials.
     *
     * @param AuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request)
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
     * Register a User.
     *
     * @param AuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRequest $request) {

        $user = $this->repository->create($request->validated());
        return $this->successCreated($user->toArray());
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @param AuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(AuthRequest $request)
    {
        try {
            JWTAuth::invalidate($request->token);
            return $this->successNotContent();
        } catch (JWTException $exception) {
            return $this->error(['message' => 'Sorry, user cannot be logged out'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}