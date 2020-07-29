<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        
        for ($i = 0; $i < 10; $i++) {
        	$categories = \App\Category::all();
        	$products = \App\Product::all();
        	
        	foreach ($products as $product) {
        		$categories->random(rand(2, 10))->pluck('id')->toArray();
        		
        		foreach ($categories as $category) {
					DB::table('category_product')->insert([
						'category_id' => $category->id,
						'product_id'  => $product->id
					]);
				}
			}
		}
    }
}
