<?php


namespace App\Repository;


use App\Category;
use App\Product;
use App\Contracts\ProductContract;
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
		$product = $this->create([
			'name' => $params['name'],
			'is_published' => filter_var($params['is_published'], FILTER_VALIDATE_BOOLEAN),
			'sort' => $params['sort'],
			'price' => $params['price']
		]);
		
		$product->load('categories');
		$this->syncCategoryIds($params['categories'], $product);
		
		$product->save();
		
		return $product;
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function updateProduct(array $params, int $id): Product
	{
		$product = $this->update([
			'name' => $params['name'],
			'is_published' => filter_var($params['is_published'], FILTER_VALIDATE_BOOLEAN),
			'sort' => $params['sort'],
			'price' => $params['price']
		], $id);
		
		$product->load('categories');
		$this->syncCategoryIds($params['categories'], $product);
		
		$product->save();
		
		return $product;
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function deleteProduct(int $id): Product
	{
		$product = $this->update([
			'is_deleted' => true
		], $id);
		$product->save();
		
		return $product;
	}
	
	/**
	 * Attach categories to product.
	 *
	 * @param  array         $categoryIds
	 * @param  \App\Product  $product
	 */
	private function syncCategoryIds(array $categoryIds, Product $product): void
	{
		$categories = Category::find($categoryIds);
		$product->categories()->sync($categories);
	}
}