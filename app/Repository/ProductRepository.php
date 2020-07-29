<?php


namespace App\Repository;


use App\Contracts\ProductContract;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository implements ProductContract
{
	public function __construct(Product $model)
	{
		parent::__construct($model);
		$this->model = $model;
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function listProducts(array $columns = ['*'], string $order = 'id', string $sort = 'desc'): Collection
	{
		return $this->all($columns, $order, $sort);
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function findProductById(int $id): ?Product
	{
		return $this->find($id);
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function findProductBy(array $data): Model
	{
		return $this->findBy($data);
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function createProduct(array $params): Product
	{
		return $this->create($params);
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function updateProduct(array $params, int $id): Product
	{
		return $this->update($params, $id);
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function deleteProduct(int $id): bool
	{
		try {
			return $this->delete($id);
		} catch (\Exception $e) {
			return false;
		}
	}
}