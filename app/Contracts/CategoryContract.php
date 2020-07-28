<?php


namespace App\Contracts;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Category;

interface CategoryContract
{
	/**
	 * Get collection all records.
	 *
	 * Получить коллекцию всех записей.
	 *
	 * @param  array|string[]  $columns
	 *
	 * @return Collection
	 */
	public function allCategories(array $columns = ['*']): Collection;
	
	/**
	 * Get paginate collection all records.
	 *
	 * Получить коллекцию всех записей с пагинацей.
	 *
	 * @param  int    $perPage
	 * @param  array  $columns
	 * @param  int    $page
	 *
	 * @return LengthAwarePaginator
	 */
	public function paginateCategories(int $perPage, array $columns, int $page): LengthAwarePaginator;
	
	/**
	 * Create new instance model.
	 *
	 * Создать новый экземпляр модели.
	 *
	 * @param  array  $params
	 *
	 * @return null|Category
	 */
	public function createCategory(array $params): ?Category;
	
	/**
	 * Update model by the given ID.
	 *
	 * Обновить модель по заданному ID.
	 *
	 * @param  array  $params
	 * @param  int    $id
	 *
	 * @return null|Category
	 */
	public function updateCategory(int $id, array $params): ?Category;
	
	/**
	 * Find model by the given ID.
	 *
	 * Найти модель по заданному ID.
	 *
	 * @param  int             $id
	 * @param  array|string[]  $columns
	 *
	 * @return null|Category
	 */
	public function findByIdCategory(int $id, array $columns = ['*']): ?Category;
}