<?php

namespace Messi\Base\Schemas\Parameter;

/**
 * @OA\Parameter(
 *      parameter="general--orderBy",
 *      in="query",
 *      name="orderBy",
 *      @OA\Schema(
 *          type="string",
 *          default="",
 *          example="id;created_at"
 *      )
 * )
 */
class OrderByParameterSchema
{

}
