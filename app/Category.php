<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'active',
        'sort'
    ];

    protected $casts = [
        'name' => 'string',
        'active' => 'boolean',
        'sort' => 'integer'
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product')
            ->withPivotValue(['category_id', 'product_id']);
    }
}
