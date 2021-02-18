<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category =Category::first()->id;
        Product::create([
            'name'=>'Laptop',
            'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi reprehenderit suscipit incidunt commodi nihil, 
            quo a! Reiciendis qui ipsa excepturi reprehenderit saepe at nulla, animi eveniet eum, et tempore numquam.',
            'price'=>25.90,
            'cost'=>10.8,
            'stock'=>100,
            'category_id'=>$category

            ]);

        
        factory(Product::class)->times(19)->create();
    }
}
