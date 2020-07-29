<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Category
 *
 * @property int                                                          $id
 * @property string                                                       $name
 * @property bool                                                         $active
 * @property int                                                          $sort
 * @property \Illuminate\Support\Carbon|null                              $created_at
 * @property \Illuminate\Support\Carbon|null                              $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null                                                $products_count
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereActive($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereSort($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
	protected $table = 'categories';
	
	protected $fillable = [
		'name',
		'active',
		'sort'
	];
	
	protected $casts = [
		'name'   => 'string',
		'active' => 'boolean',
		'sort'   => 'integer'
	];
	
	/**
	 * @return BelongsToMany
	 */
	public function products(): BelongsToMany
	{
		return $this->belongsToMany(Product::class,
			'category_product',
			'category_id',
			'product_id'
		)->withPivot(['category_id', 'product_id']);
	}
}
