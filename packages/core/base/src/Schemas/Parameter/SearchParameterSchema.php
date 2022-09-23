<?php

namespace Messi\Base\Schemas\Parameter;

/**
 * @OA\Parameter(
 *      parameter="general--search",
 *      in="query",
 *      name="search",
 *      @OA\Schema(
 *          type="string",
 *          default="",
 *          example="title:Thai;is_featured:1;status:111 || price:300,500 || price:300,500"
 *      )
 * )
 */
class SearchParameterSchema
{

}
