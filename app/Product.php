<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Product
 *
 * @property int                                                           $id
 * @property string                                                        $name
 * @property bool                                                          $is_published
 * @property int                                                           $sort
 * @property float                                                         $price
 * @property \Illuminate\Support\Carbon|null                               $created_at
 * @property \Illuminate\Support\Carbon|null                               $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read int|null                                                 $categories_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereIsPublished($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereSort($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $is_deleted
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereIsDeleted($value)
 */
class Product extends Model
{
	protected $table = 'products';
	
	protected $fillable = [
		'name',
		'is_published',
		'sort',
		'price',
		'is_deleted'
	];
	
	protected $casts = [
		'name'         => 'string',
		'is_published' => 'boolean',
		'is_deleted'   => 'boolean',
		'sort'         => 'integer',
		'price'        => 'float',
	];
	
	/**
	 * @return BelongsToMany
	 */
	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(
			Category::class,
			'category_product',
		'product_id',
			'category_id'
		)->withPivot(['category_id', 'product_id']);
	}
}
