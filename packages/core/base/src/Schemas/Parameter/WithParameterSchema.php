<?php

namespace Messi\Base\Schemas\Parameter;

/**
 * @OA\Parameter(
 *      parameter="general--with",
 *      in="query",
 *      name="with",
 *      @OA\Schema(
 *          type="string",
 *          default="",
 *          example="createdBy;parent;updatedBy;posts"
 *      )
 * )
 */
class WithParameterSchema
{

}
