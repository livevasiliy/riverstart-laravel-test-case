<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\CreateProductAPIRequest;
use App\Http\Requests\UpdateProductAPIRequest;
use App\Services\ProductService;
use Illuminate\Routing\Controller;

/**
 * Class ProductAPIController
 * @package App\Http\Controllers\API\V1
 */
class ProductAPIController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductAPIController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    final public function index(): \Illuminate\Http\JsonResponse
	{
        return $this->productService->index();
    }
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  CreateProductAPIRequest  $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
    final public function store(CreateProductAPIRequest $request): \Illuminate\Http\JsonResponse
	{
        return $this->productService->store($request);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
    final public function show(int $id): \Illuminate\Http\JsonResponse
	{
        return $this->productService->show($id);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  UpdateProductAPIRequest  $request
	 * @param  int                  $id
	 * @return \Illuminate\Http\JsonResponse
	 */
    final public function update(int $id, UpdateProductAPIRequest $request): \Illuminate\Http\JsonResponse
	{
        return $this->productService->update($id, $request);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    final public function destroy(int $id): \Illuminate\Http\JsonResponse
	{
        return $this->productService->destroy($id);
    }
}
