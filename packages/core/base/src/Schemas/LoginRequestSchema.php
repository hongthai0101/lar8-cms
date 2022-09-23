<?php

namespace Messi\Base\Schemas;

/**
 * @OA\Schema(
 *     title="LoginRequest",
 *     description="LoginRequest",
 *     @OA\Xml(
 *         name="LoginRequest"
 *     )
 * )
 * @SuppressWarnings(PHPMD)
 */
class LoginRequestSchema
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="email of user",
     *      example="email@gmail.com"
     * )
     *
     * @var string
     */
    public string $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="password of user",
     *      example="password"
     * )
     *
     * @var string
     */
    public string $password;
}
