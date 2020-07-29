<?php


namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Category;

/**
 * Interface CategoryContract
 *
 * @package App\Contracts
 */
interface CategoryContract
{
    /**
     * @param  array   $columns
     * @param  string  $order
     * @param  string  $sort
     *
     * @return Collection|array
     */
    public function listCategories(array $columns = ['*'], string $order = 'id', string $sort = 'desc'): Collection;
    
    /**
     * @param  int  $id
     *
     * @return Category
     */
    public function findCategoryById(int $id): ?Category;
    
    /**
     * @param  array  $params
     *
     * @return Category
     */
    public function createCategory(array $params): Category;
    
    /**
     * @param  array  $params
     * @param  int    $id
     *
     * @return Category
     */
    public function updateCategory(array $params, int $id): Category;
    
    /**
     * @param  int  $id
     *
     * @return bool
     */
    public function deleteCategory(int $id): bool;
}
