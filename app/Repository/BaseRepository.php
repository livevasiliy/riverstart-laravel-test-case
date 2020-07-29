<?php


namespace App\Repository;

use App\Contracts\BaseContract;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class BaseRepository
 *
 * @package \App\Repository
 */
class BaseRepository implements BaseContract
{
    /**
     * @var Model
     */
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
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param  array  $attributes
     * @param  int    $id
     *
     * @return mixed
     */
    public function update(array $attributes, int $id)
    {
        return $this->find($id)->update($attributes);
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param  array   $columns
     * @param  string  $orderBy
     * @param  string  $sortBy
     *
     * @return mixed
     */
    public function all($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc')
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * @param  array  $data
     * @param  int    $perCount
     *
     * @return LengthAwarePaginator
     */
    public function paginate(array $data, int $perCount): LengthAwarePaginator
    {
        return $this->model->where($data)->paginate($perCount);
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneOrFail(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function findBy(array $data)
    {
        return $this->model->where($data)->all();
    }

    /**
     * @param  array  $data
     *
     * @return array
     */
    public function createMany(array $data): array
    {
        $result = array();
        foreach ($data as $element) {
            $result[] = $this->model->create($element);
        }

        return $result;
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function findOneBy(array $data)
    {
        return $this->model->where($data)->first();
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }

    /**
     * @param  int  $id
     *
     * @return bool
     * @throws Exception
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Возвращает последний ID записи.
     *
     * @return int|null
     */
    public function getLastId(): ?int
    {
        $id = $this->model->orderByDesc('id')->first(['id']);
        return $id ? $id->id : null;
    }
}
