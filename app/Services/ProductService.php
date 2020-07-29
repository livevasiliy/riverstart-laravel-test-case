<?php


namespace App\Services;


use App\Contracts\ProductContract;
use App\Http\Requests\CreateProductAPIRequest;
use App\Http\Requests\UpdateProductAPIRequest;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductService
{
	/**
	 * @var \App\Contracts\ProductContract
	 */
	private $productRepository;
	
	
	/**
	 * ProductService constructor.
	 *
	 * @param  \App\Contracts\ProductContract  $productRepository
	 */
	public function __construct(ProductContract $productRepository)
	{
		$this->productRepository = $productRepository;
	}
	
	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	final public function index(): JsonResponse
	{
		$products = new ProductCollection($this->productRepository->listProducts());
		
		return response()->json($products, Response::HTTP_OK);
	}
	
	/**
	 * @param  \App\Http\Requests\CreateProductAPIRequest  $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	final public function store(CreateProductAPIRequest $request): JsonResponse
	{
		$product = $this->productRepository->createProduct($request->all());
		
		if ($product === null) {
			return response()->json([], Response::HTTP_BAD_REQUEST);
		}
		
		return response()->json($product, Response::HTTP_CREATED);
	}
	
	final public function show(int $id): JsonResponse
	{
		$product = $this->productRepository->findProductById($id);
		
		if ($product === null) {
			return response()->json([], Response::HTTP_NOT_FOUND);
		}
		
		return response()->json($product, Response::HTTP_FOUND);
	}
	
	/**
	 * @param  int                                         $id
	 * @param  \App\Http\Requests\UpdateProductAPIRequest  $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	final public function update(int $id, UpdateProductAPIRequest $request): JsonResponse
	{
		$product = $this->productRepository->findProductById($id);
		
		if ($product === null) {
			return response()->json([], Response::HTTP_NOT_FOUND);
		}
		
		$product = $this->productRepository->updateProduct($request->all(), $id);
		
		if ($product === null) {
			return response()->json([], Response::HTTP_BAD_REQUEST);
		}
		
		return response()->json(ProductCollection::make($product), Response::HTTP_OK);
	}
	
	/**
	 * @param  int  $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	final public function destroy(int $id): JsonResponse
	{
		$product = $this->productRepository->findProductById($id);
		
		if ($product === null) {
			return response()->json(new ProductCollection([]), Response::HTTP_NOT_FOUND);
		}
		
		if ($product->delete() === false) {
			return response()->json([], Response::HTTP_BAD_REQUEST);
		}
		
		$categories = $this->productRepository->listProducts([
			'id',
			'name',
			'active',
			'sort'
		]);
		
		return response()->json(new ProductCollection($categories), Response::HTTP_OK);
	}
}
