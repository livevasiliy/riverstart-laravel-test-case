<?php

namespace App\Services;

use App\Contracts\CategoryContract;
use App\Http\Requests\CreateCategoryAPIRequest;
use App\Http\Requests\UpdateCategoryAPIRequest;
use App\Http\Resources\CategoryCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryService
{
	/**
	 * @var \App\Contracts\CategoryContract
	 */
	private $categoryRepository;
	
	/**
	 * CategoryService constructor.
	 *
	 * @param  \App\Contracts\CategoryContract  $categoryRepository
	 */
	public function __construct(CategoryContract $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}
	
	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	final public function index(): JsonResponse
    {
		$categories = new CategoryCollection($this->categoryRepository->allCategories([
			'id',
			'name',
			'active',
			'sort'
		]));
		
		return response()->json($categories, Response::HTTP_OK);
    }
	
	/**
	 * @param  \App\Http\Requests\CreateCategoryAPIRequest  $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    final public function store(CreateCategoryAPIRequest $request): JsonResponse
    {
		$category = $this->categoryRepository->createCategory($request->all());
		
		if ($category === null) {
			return response()->json([], Response::HTTP_BAD_REQUEST);
		}
		
		return response()->json($category, Response::HTTP_CREATED);
    }

    final public function show(int $id): JsonResponse
    {
		$category = $this->categoryRepository->findByIdCategory($id);
		
		if ($category === null) {
			return response()->json([], Response::HTTP_NOT_FOUND);
		}
		
		return response()->json($category, Response::HTTP_FOUND);
    }
	
	/**
	 * @param  int                                          $id
	 * @param  \App\Http\Requests\UpdateCategoryAPIRequest  $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    final public function update(int $id, UpdateCategoryAPIRequest $request): JsonResponse
    {
		$category = $this->categoryRepository->findByIdCategory($id);
	
		if ($category === null) {
			return response()->json([], Response::HTTP_NOT_FOUND);
		}
		
		$category = $this->categoryRepository->updateCategory($id, $request->all());
		
		if ($category === null) {
			return response()->json([], Response::HTTP_BAD_REQUEST);
		}
		
		return response()->json(CategoryCollection::make($category), Response::HTTP_OK);
    }
	
	/**
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    final public function destroy(int $id): JsonResponse
    {
		$category = $this->categoryRepository->findByIdCategory($id);
	
		if ($category === null) {
			return response()->json(new CategoryCollection([]), Response::HTTP_NOT_FOUND);
		}
		
		if ($category->delete() === false) {
			return response()->json([], Response::HTTP_BAD_REQUEST);
		}
	
		$categories = $this->categoryRepository->allCategories([
			'id',
			'name',
			'active',
			'sort'
		]);
		
		return response()->json(new CategoryCollection($categories), Response::HTTP_OK);
    }
}
