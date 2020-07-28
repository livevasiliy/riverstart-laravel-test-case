<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\CreateCategoryAPIRequest;
use App\Http\Requests\UpdateCategoryAPIRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/***
 * Class CategoryAPIController
 *
 * @package App\Http\Controllers\API\V1
 */
class CategoryAPIController extends Controller
{
	/**
	 * @var CategoryService
	 */
	private $categoryService;
	
	/**
	 * CategoryAPIController constructor.
	 *
	 * @param  CategoryService  $categoryService
	 */
	public function __construct(CategoryService $categoryService)
	{
		$this->categoryService = $categoryService;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	final public function index(): JsonResponse
	{
		return $this->categoryService->index();
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  CreateCategoryAPIRequest  $request
	 *
	 * @return JsonResponse
	 */
	final public function store(CreateCategoryAPIRequest $request): JsonResponse
	{
		return $this->categoryService->store($request);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 *
	 * @return JsonResponse
	 */
	final public function show(int $id): JsonResponse
	{
		return $this->categoryService->show($id);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int                       $id
	 * @param  UpdateCategoryAPIRequest  $request
	 *
	 * @return JsonResponse
	 */
	final public function update(int $id, UpdateCategoryAPIRequest $request): JsonResponse
	{
		return $this->categoryService->update($id, $request);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 *
	 * @return JsonResponse
	 * @throws \Exception
	 */
	final public function destroy(int $id): JsonResponse
	{
		return $this->categoryService->destroy($id);
	}
}
