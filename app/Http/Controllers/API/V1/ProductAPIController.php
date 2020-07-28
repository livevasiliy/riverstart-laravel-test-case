<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\CreateProductAPIRequest;
use App\Http\Requests\UpdateProductAPIRequest;
use App\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;
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
     * @return Response
     */
    public function index()
    {
        return $this->productService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductAPIRequest $request
     * @return Response
     */
    public function store(CreateProductAPIRequest $request)
    {
        return $this->productService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        return $this->productService->show($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductAPIRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(UpdateProductAPIRequest $request, Product $product)
    {
        return $this->productService->update($request, $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        return $this->productService->destroy($product);
    }
}
