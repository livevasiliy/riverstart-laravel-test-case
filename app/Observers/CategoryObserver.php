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
	 * @return bool
	 */
	final public function deleting(Category $category): bool
	{
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
    	return true;
    }
}
