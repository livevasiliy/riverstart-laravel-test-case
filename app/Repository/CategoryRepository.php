<?php


namespace App\Repository;


use App\Category;
use App\Contracts\CategoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository implements CategoryContract
{
	public function __construct(Category $model)
	{
		parent::__construct($model);
		$this->model = $model;
	}
	
	final public function allCategories(array $columns = ['*']): Collection
	{
		return $this->all($columns);
	}
	
	final public function paginateCategories(int $perPage, array $columns, int $page): LengthAwarePaginator
	{
		return $this->model->orderByDesc('id')->paginate($perPage, $columns, $page);
	}
	
	final public function createCategory(array $params): ?Category
	{
		return $this->model->create($params);
	}
	
	final public function updateCategory(int $id, array $params): ?Category
	{
		return $this->model->find($id)->fill($params);
	}
	
	final public function findByIdCategory(int $id, array $columns = ['*']): ?Category
	{
		return $this->model->whereId($id)->first($columns);
	}
}