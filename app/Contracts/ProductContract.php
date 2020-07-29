<?php


namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Product;

/**
 * Interface ProductContract
 *
 * @package App\Contracts
 */
interface ProductContract
{
	/**
	 * @param  array  $params
	 *
	 * @return mixed
	 */
	public function listProducts(array $params): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
	
	/**
	 * @param  int  $id
	 *
	 * @return Product
	 */
	public function findProductById(int $id): ?Product;
	
	/**
	 * @param  array  $params
	 *
	 * @return Product
	 */
	public function createProduct(array $params): Product;
	
	/**
	 * @param  array  $params
	 * @param  int    $id
	 *
	 * @return Product
	 */
	public function updateProduct(array $params, int $id): Product;
	
	/**
	 * @param  int  $id
	 *
	 * @return Product
	 */
	public function deleteProduct(int $id): Product;
	
	/**
	 * @param  array  $data
	 *
	 * @return Model
	 */
	public function findProductBy(array $data): Model;
}
