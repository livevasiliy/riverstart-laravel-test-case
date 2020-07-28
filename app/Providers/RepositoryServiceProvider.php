<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
	protected $repositories = [
		ProductContract::class  => ProductRepository::class,
		CategoryContract::class => CategoryRepository::class
	];
	
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		foreach ($this->repositories as $contract => $repository) {
			$this->app->bind($contract, $repository);
		}
	}
	
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
}
