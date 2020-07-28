<?php


namespace App\Contracts;


use App\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProductContract
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
	public function allProducts(array $columns = ['*']): Collection;
	
	/**
	 * Get paginate collection all records.
	 *
	 * Получить коллекцию всех записей с пагинацей.
	 *
	 * @param  int  $perPage
	 * @param  int  $page
	 *
	 * @return LengthAwarePaginator
	 */
	public function paginateProducts(int $perPage, int $page): LengthAwarePaginator;
	
	/**
	 * Create new instance model.
	 *
	 * Создать новый экземпляр модели.
	 *
	 * @param  array  $params
	 *
	 * @return null|Product
	 */
	public function createProduct(array $params): ?Product;
	
	/**
	 * Update model by the given ID.
	 *
	 * Обновить модель по заданному ID.
	 *
	 * @param  array  $params
	 * @param  int    $id
	 *
	 * @return null|Product
	 */
	public function updateProduct(int $id, array $params): ?Product;
	
	/**
	 * Find model by a specific column.
	 *
	 * Найти модель по конкретному столбцу.
	 *
	 * @param  array           $params
	 * @param  array|string[]  $columns
	 *
	 * @return null|Product
	 */
	public function findByProduct(array $params, array $columns = ['*']): ?Product;
	
	/**
	 * Find model by the given ID.
	 *
	 * Найти модель по заданному ID.
	 *
	 * @param  int             $id
	 * @param  array|string[]  $columns
	 *
	 * @return null|Product
	 */
	public function findByIdProduct(int $id, array $columns = ['*']): ?Product;
}