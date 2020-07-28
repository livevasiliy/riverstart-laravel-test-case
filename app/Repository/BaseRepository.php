<?php


namespace App\Repository;


use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * Class BaseRepository
 *
 * @package App\Repository
 */
class BaseRepository implements BaseContract
{
	/** @var Model */
	protected $model;
	
	/**
	 * BaseRepository constructor.
	 *
	 * @param  Model  $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}
	
	
	/**
	 * Get all
	 *
	 * @param  array|string[]  $columns
	 *
	 * @return Collection
	 */
	final public function all(array $columns = ['*']): Collection
	{
		return $this->model->get($columns);
	}
	
	/**
	 * Paginate all
	 *
	 * @param  int             $perPage
	 * @param  array|string[]  $columns
	 * @param  string          $pageName
	 * @param  int             $page
	 *
	 * @return Paginator
	 */
	final public function paginate(
		int $perPage = 15,
		array $columns = ['*'],
		string $pageName = 'data',
		int $page = 1
	): Paginator {
		return $this->model->paginate($perPage, $columns, $pageName, $page);
	}
	
	/**
	 * Create new instance model
	 *
	 * @param  array  $params
	 *
	 * @return Model|null
	 */
	final public function create(array $params): ?Model
	{
		return $this->model->create($params);
	}
	
	/**
	 * Find model by the given ID
	 *
	 * @param  int  $id
	 *
	 * @return Model|null
	 */
	final public function show(int $id): ?Model
	{
		return $this->find($id);
	}
	
	/**
	 * Find model by ID
	 *
	 * @param  int             $id
	 * @param  array|string[]  $columns
	 *
	 * @return Model|null
	 */
	final public function find(int $id, array $columns = ['*']): ?Model
	{
		return $this->model->whereId($id)->first($columns);
	}
	
	/**
	 * Update model by the given ID
	 *
	 * @param  int    $id
	 * @param  array  $params
	 *
	 * @return bool
	 */
	final public function update(int $id, array $params): bool
	{
		return $this->model->whereId($id)->update($params);
	}
	
	/**
	 * Delete model by the given ID
	 *
	 * @param  int  $id
	 *
	 * @return bool
	 */
	final public function delete(int $id): bool
	{
		return $this->model->destroy($id);
	}
	
	/**
	 * Find model by the given params
	 *
	 * @param  array           $params
	 * @param  array|string[]  $columns
	 *
	 * @return Model|null
	 */
	final public function findBy(array $params, array $columns = ['*']): ?Model
	{
		return $this->model::where($params)->first($columns);
	}
}
