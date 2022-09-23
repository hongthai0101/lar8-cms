<?php

namespace Messi\Base\Schemas\Parameter;

/**
 * @OA\Parameter(
 *      parameter="general--searchJoin",
 *      in="query",
 *      name="searchJoin",
 *     description="Default query or, if input and will query with AND",
 *      @OA\Schema(
 *          type="string",
 *          default="or",
 *          example="and"
 *      )
 * )
 */
class SearchJoinParameterSchema
{

}
