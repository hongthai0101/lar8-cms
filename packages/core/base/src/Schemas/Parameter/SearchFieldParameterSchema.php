<?php

namespace Messi\Base\Schemas\Parameter;

/**
 * @OA\Parameter(
 *      parameter="general--searchFields",
 *      in="query",
 *      name="searchFields",
 *      @OA\Schema(
 *          type="string",
 *          default="",
 *          example="title:like;is_featured:=;status= || price:between || price:in"
 *      )
 * )
 */
class SearchFieldParameterSchema
{

}
