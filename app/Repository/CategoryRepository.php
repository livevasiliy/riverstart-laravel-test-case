<?php


namespace App\Repository;


use App\Category;
use App\Contracts\CategoryContract;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements CategoryContract
{
	/**
	 * {@inheritDoc}
	 */
	public function __construct(Category $model)
	{
		parent::__construct($model);
		$this->model = $model;
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function listCategories(
		array $columns = ['*'],
		string $order = 'id',
		string $sort = 'desc'
	): Collection {
		return $this->all($columns, $order, $sort);
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function findCategoryById(int $id): ?Category
	{
		return $this->find($id);
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function createCategory(array $params): Category
	{
		return $this->create($params);
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function updateCategory(array $params, int $id): Category
	{
		return $this->update($params, $id);
	}
	
	/**
	 * {@inheritDoc}
	 */
	final public function deleteCategory(int $id): bool
	{
		try {
			return $this->delete($id);
		} catch (\Exception $e) {
			return false;
		}
	}
}