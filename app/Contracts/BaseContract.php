<?php


namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

/***
 * Interface BaseContract
 *
 * @package App\Contracts
 */
interface BaseContract
{
	/**
	 * Get collection all records
	 *
	 * @param  array|string[]  $columns
	 *
	 * @return Collection
	 */
	public function all(array $columns = ['*']): Collection;
	
	/**
	 * Get paginate collection all records
	 *
	 * @param  int             $perPage
	 * @param  array|string[]  $columns
	 * @param  string          $pageName
	 * @param  int             $page
	 *
	 * @return Paginator
	 */
	public function paginate(
		int $perPage = 15,
		array $columns = ['*'],
		string $pageName = 'data',
		int $page = 1
	): Paginator;
	
	/**
	 * Create new instance model
	 *
	 * @param  array  $params
	 *
	 * @return Model|null
	 */
	public function create(array $params): ?Model;
	
	/**
	 * Find model by the given ID
	 *
	 * @param  int  $id
	 *
	 * @return Model|null
	 */
	public function show(int $id): ?Model;
	
	/**
	 * Update model by the given ID
	 *
	 * @param  array  $params
	 * @param  int    $id
	 *
	 * @return bool
	 */
	public function update(int $id, array $params): bool;
	
	/**
	 * Delete model by the given ID
	 *
	 * @param  int  $id
	 *
	 * @return bool
	 */
	public function delete(int $id): bool;
	
	/**
	 * Find model by a specific column
	 *
	 * @param  array           $params
	 * @param  array|string[]  $columns
	 *
	 * @return Model|null
	 */
	public function findBy(array $params, array $columns = ['*']): ?Model;
	
	/**
	 * Find model by ID
	 *
	 * @param  int             $id
	 * @param  array|string[]  $columns
	 *
	 * @return Model|null
	 */
	public function find(int $id, array $columns = ['*']): ?Model;
}
