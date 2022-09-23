<?php

namespace Messi\Blog\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Messi\Base\Http\Controllers\Api\ApiController;
use Messi\Blog\Http\Collections\CategoryCollection;
use Messi\Blog\Http\Requests\Api\CategoryRequest;
use Messi\Blog\Http\Resources\CategoryResource;
use Messi\Blog\Repositories\Contracts\CategoryRepository;

class CategoryController extends ApiController
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $repository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\Get (
     *     path="/api/v1/categories",
     *     tags={"Category"},
     *     summary="List Category",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(
     *          ref="#/components/parameters/general--search",
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/general--searchFields",
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/general--searchJoin",
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/general--filter",
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/general--orderBy",
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/general--sortedBy",
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/general--with",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  type="integer",
     *                  default="15",
     *                  property="total"
     *              ),
     *              @OA\Property(
     *                  type="boolean",
     *                  default="true",
     *                  property="has_more"
     *              ),
     *              @OA\Property(
     *                      type="array",
     *                      property="data",
     *                      @OA\Items(
     *                          type="object",
     *                          ref="#/components/schemas/CategoryResource"
     *                      )
     *              )
     *          ),
     *       ),
     * )
     *
     * @param Request $request
     * @return CategoryCollection
     */
    public function index(Request $request): CategoryCollection
    {
        $items = $this->repository->paginate();
        return new CategoryCollection($items);
    }

    /**
     * @OA\Get (
     *     path="/api/v1/categories/{id}",
     *     tags={"Category"},
     *     summary="Show Category",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *          ref="#/components/parameters/general--with",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/CategoryResource"
     *          ),
     *       ),
     * )
     *
     * @param int $id
     * @return CategoryResource
     */
    public function show(int $id): CategoryResource
    {
        $item = $this->repository->find($id);
        return new CategoryResource($item);
    }

    /**
     * @OA\Post (
     *     path="/api/v1/categories",
     *     tags={"Category"},
     *     summary="Store Category",
     *     security={{"bearerToken":{}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CategoryRequest")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/CategoryResource"
     *          ),
     *       ),
     * )
     *
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function store(CategoryRequest $request): CategoryResource
    {
        $item = $this->repository->create($request->all());
        return new CategoryResource($item);
    }

    /**
     * @OA\Put (
     *     path="/api/v1/categories",
     *     tags={"Category"},
     *     summary="Store Category",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CategoryRequest")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/CategoryResource"
     *          ),
     *       ),
     * )
     *
     * @param int $id
     * @param CategoryRequest $request
     * @return CategoryResource
     */
    public function update(int $id, CategoryRequest $request): CategoryResource
    {
        $item = $this->repository->update($request->all(), $id);
        return new CategoryResource($item);
    }

    /**
     * @OA\Delete (
     *     path="/api/v1/categories/{id}",
     *     tags={"Category"},
     *     summary="Delete Category",
     *     security={{"bearerToken":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *          @OA\JsonContent(),
     *       ),
     * )
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->repository->delete($id);
        return $this->successNotContent();
    }
}
