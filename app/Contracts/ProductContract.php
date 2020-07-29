<?php


namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Product;

/**
 * Interface ProductContract
 *
 * @package App\Contracts
 */
interface ProductContract
{
    /**
     * @param  array   $columns
     * @param  string  $order
     * @param  string  $sort
     *
     * @return mixed
     */
    public function listProducts(array $columns = ['*'], string $order = 'id', string $sort = 'desc'): Collection;
    
    /**
     * @param  int  $id
     *
     * @return Product
     */
    public function findProductById(int $id): ?Product;
    
    /**
     * @param  array  $params
     *
     * @return Product
     */
    public function createProduct(array $params): Product;
    
    /**
     * @param  array  $params
     * @param  int    $id
     *
     * @return Product
     */
    public function updateProduct(array $params, int $id): Product;
    
    /**
     * @param  int  $id
     *
     * @return bool
     */
    public function deleteProduct(int $id): bool;
    
    /**
     * @param  array  $data
     *
     * @return Model
     */
    public function findProductBy(array $data): Model;
}
