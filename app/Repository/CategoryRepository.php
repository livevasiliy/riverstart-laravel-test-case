<?php


namespace App\Repository;


use App\Category;
use App\Contracts\CategoryContract;

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
	public function listCategories(
		array $columns = ['*'],
		string $order = 'id',
		string $sort = 'desc'
	): \Illuminate\Database\Eloquent\Collection {
		return $this->all($columns, $order, $sort);
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function findCategoryById(int $id): ?Category
	{
		return $this->find($id);
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function createCategory(array $params): Category
	{
		return $this->create($params);
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function updateCategory(array $params, int $id): Category
	{
		return $this->update($params, $id);
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function deleteCategory(int $id): bool
	{
		try {
			return $this->delete($id);
		} catch (\Exception $e) {
			return false;
		}
	}
}