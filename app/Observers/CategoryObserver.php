<?php

namespace App\Observers;

use App\Category;

class CategoryObserver
{
	/**
	 * Handle the category "deleting" event.
	 *
	 * @param  \App\Category  $category
	 *
	 * @return bool|void
	 */
	final public function deleting(Category $category)
	{
		$category->load('products');
		
		$products = $category->products()->wherePivot('category_id', '=', $category->id)->count();
		
		if ($products > 0) {
			return false;
		}
		
		return true;
	}

    /**
     * Handle the category "force deleted" event.
     *
     * @param  \App\Category  $category
     *
	 * @return bool
     */
    final public function forceDeleted(Category $category): bool
    {
    	return false;
    }
}
