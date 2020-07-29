<?php


namespace App\Repository;


use App\Category;
use App\Product;
use App\Contracts\ProductContract;
use Illuminate\Database\Eloquent\Builder;
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
	final public function listProducts(array $params): \Illuminate\Contracts\Pagination\LengthAwarePaginator
	{
		$products = Product::query();
		
		// Не реализовал поиск по ID категории и по названию категории.
		
		foreach ($params as $key => $value)
		{
			if ($key === 'name')
			{
				$products->where('name', 'like', '%'.$value.'%');
			}
			
			else if ($key === 'is_published') {
				$products->whereIsPublished(filter_var($value, FILTER_VALIDATE_BOOLEAN));
			}
			
			else if ($key === 'is_deleted') {
				$products->whereIsDeleted(filter_var($value, FILTER_VALIDATE_BOOLEAN));
			}
			
			else if ($key === 'min_price') {
				$products->where('price', '>=', $value);
			}
			
			else if ($key === 'max_price') {
				$products->where('price', '<=', $value);
			}
		}
		
		return $products->paginate(15,[
			'id', 'name', 'sort', 'is_published', 'is_deleted', 'price'
		], 'page');
		
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