<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'is_published',
        'sort',
        'price'
    ];

    protected $casts = [
        'name' => 'string',
        'is_published' => 'boolean',
        'sort' => 'integer',
        'price' => 'float'
    ];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_product')
            ->withPivotValue(['category_id', 'product_id']);
    }
}
