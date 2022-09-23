<?php

namespace Messi\Base\Schemas;

/**
 * @OA\Schema(
 *     title="LoginResponse",
 *     description="LoginResponse",
 *     @OA\Xml(
 *         name="LoginResponse"
 *     )
 * )
 * @SuppressWarnings(PHPMD)
 */
class LoginResponseSchema
{
    /**
     * @OA\Property(
     *      title="access_token",
     *      description="access_token of user",
     *      example="123.456.789"
     * )
     *
     * @var string
     */
    public string $access_token;

    /**
     * @OA\Property(
     *      title="token_type",
     *      description="Access token type when call api",
     *      example="Bearer"
     * )
     *
     * @var string
     */
    public string $token_type;

    /**
     * @OA\Property(
     *      title="expires_in",
     *      description="expires of token",
     *      example="3600"
     * )
     *
     * @var integer
     */
    public int $expires_in;
}
