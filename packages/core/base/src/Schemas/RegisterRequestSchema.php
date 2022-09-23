<?php

namespace Messi\Base\Schemas;

/**
 * @OA\Schema(
 *     title="RegisterRequest",
 *     description="RegisterRequest",
 *     @OA\Xml(
 *         name="RegisterRequest"
 *     )
 * )
 * @SuppressWarnings(PHPMD)
 */
class RegisterRequestSchema
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

    /**
     * @OA\Property(
     *      title="password_confirmation",
     *      description="password confirmation of user",
     *      example="password"
     * )
     *
     * @var string
     */
    public string $password_confirmation;

    /**
     * @OA\Property(
     *      title="phone",
     *      description="phone of user"
     * )
     *
     * @var string
     */
    public string $phone;

    /**
     * @OA\Property(
     *      title="name",
     *      description="name of user",
     *      example="name"
     * )
     *
     * @var string
     */
    public string $name;

}
